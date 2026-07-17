<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class ImportCities extends Command
{
    protected $signature = 'import:cities';
    protected $description = 'Import cities in Arabic from airports_translated.json';

    public function handle()
    {
        $jsonPath = base_path('airports_translated.json');

        if (!file_exists($jsonPath)) {
            $this->error("airports_translated.json not found at " . $jsonPath);
            return 1;
        }

        $this->info("Loading airports from airports_translated.json...");
        $json = file_get_contents($jsonPath);
        $airports = json_decode($json, true);
        if (!$airports) {
            $this->error("Invalid JSON in airports_translated.json");
            return 1;
        }

        $this->info("Found " . count($airports) . " airports to import.");

        $insertData = [];
        foreach ($airports as $iata => $airport) {
            $name = $airport['name'] ?? null;
            $city = $airport['city'] ?? null;
            $country = $airport['country'] ?? null;

            // Only import if we have name, city, country, and iata
            if ($name && $city && $country && $iata) {
                $insertData[strtoupper(trim($iata))] = [
                    'name' => trim($name),
                    'city' => trim($city),
                    'country' => trim($country),
                    'iata' => strtoupper(trim($iata)),
                    'can_be_from' => true,
                    'can_be_to' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        $this->info("Prepared " . count($insertData) . " unique records. Inserting into database...");

        $chunks = array_chunk(array_values($insertData), 1000);
        foreach ($chunks as $chunk) {
            City::insertOrIgnore($chunk);
        }

        $this->info("Successfully imported cities/airports!");
        return 0;
    }
}
