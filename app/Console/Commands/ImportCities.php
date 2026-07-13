<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class ImportCities extends Command
{
    protected $signature = 'import:cities';
    protected $description = 'Import cities in Arabic from countries+cities.json and alternateNamesV2.txt';

    public function handle()
    {
        $jsonPath = base_path('countries+cities.json');
        $altNamesPath = base_path('alternateNamesV2.txt');

        if (!file_exists($jsonPath)) {
            $this->error("countries+cities.json not found at " . $jsonPath);
            return 1;
        }

        if (!file_exists($altNamesPath)) {
            $this->error("alternateNamesV2.txt not found at " . $altNamesPath);
            return 1;
        }

        $this->info("Loading English city names from countries+cities.json...");
        $json = file_get_contents($jsonPath);
        $countries = json_decode($json, true);
        if (!$countries) {
            $this->error("Invalid JSON in countries+cities.json");
            return 1;
        }

        $cityLookup = [];
        $cityCount = 0;
        foreach ($countries as $country) {
            foreach ($country['cities'] as $cityName) {
                $cityLookup[strtolower(trim($cityName))] = [
                    'original' => $cityName,
                    'arabic' => null
                ];
                $cityCount++;
            }
        }
        $this->info("Loaded " . $cityCount . " unique city names to search for.");

        $this->info("Parsing alternateNamesV2.txt (this may take a while)...");

        $handle = fopen($altNamesPath, 'r');
        if (!$handle) {
            $this->error("Could not open alternateNamesV2.txt");
            return 1;
        }

        $currentGeonameId = null;
        $names = [];
        $lineCount = 0;

        $processGroup = function ($geonameId, $groupNames) use (&$cityLookup) {
            $arabicName = null;
            $englishNames = [];

            foreach ($groupNames as $item) {
                if ($item['lang'] === 'ar') {
                    $arabicName = $item['name'];
                } elseif ($item['lang'] === 'en' || $item['lang'] === '') {
                    $englishNames[] = strtolower(trim($item['name']));
                }
            }

            if ($arabicName) {
                foreach ($englishNames as $engName) {
                    if (isset($cityLookup[$engName])) {
                        $cityLookup[$engName]['arabic'] = $arabicName;
                    }
                }
            }
        };

        while (($line = fgets($handle)) !== false) {
            $lineCount++;
            if ($lineCount % 2000000 === 0) {
                $this->info("Processed " . ($lineCount / 1000000) . " million lines...");
            }

            $parts = explode("\t", $line);
            if (count($parts) < 4) continue;

            $geonameId = $parts[1];
            $lang = $parts[2];
            $name = trim($parts[3]);

            if ($geonameId !== $currentGeonameId) {
                if ($currentGeonameId !== null) {
                    $processGroup($currentGeonameId, $names);
                }
                $currentGeonameId = $geonameId;
                $names = [];
            }

            $names[] = ['lang' => $lang, 'name' => $name];
        }

        if ($currentGeonameId !== null) {
            $processGroup($currentGeonameId, $names);
        }
        fclose($handle);

        $this->info("Alternate names parsed. Preparing database import...");

        $insertData = [];
        foreach ($cityLookup as $engName => $data) {
            if ($data['arabic']) {
                $insertData[$data['arabic']] = [
                    'name' => $data['arabic'],
                    'can_be_from' => true,
                    'can_be_to' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        $this->info("Found " . count($insertData) . " cities with Arabic names.");

        $this->info("Inserting into database...");
        
        $chunks = array_chunk(array_values($insertData), 1000);
        foreach ($chunks as $chunk) {
            City::insertOrIgnore($chunk);
        }

        $this->info("Successfully imported cities!");
        return 0;
    }
}
