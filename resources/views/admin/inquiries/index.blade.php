@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">طلبات الحجز والاستفسارات</h2>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>المعرف</th>
                        <th>الاسم</th>
                        <th>رقم الهاتف</th>
                        <th>البريد الإلكتروني</th>
                        <th>المسار المطلوب</th>
                        <th>تاريخ السفر</th>
                        <th>الركاب (كبير/أطفال/رضيع)</th>
                        <th>تفاصيل الرسالة</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr
                            style="{{ $inquiry->status === 'pending' ? 'font-weight: bold; background-color: rgba(0,180,216,0.05);' : '' }}">
                            <td>{{ $inquiry->id }}</td>
                            <td>{{ $inquiry->full_name }}</td>
                            <td>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $inquiry->phone_number) }}"
                                    target="_blank"
                                    style="color: var(--accent); font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 4px;">
                                    💬 {{ $inquiry->phone_number }}
                                </a>
                            </td>
                            <td>{{ $inquiry->email ?? 'لا يوجد' }}</td>
                            <td>
                                @if($inquiry->from_city || $inquiry->to_city)
                                    من <strong>{{ $inquiry->from_city ?? 'غير محدد' }}</strong> إلى
                                    <strong>{{ $inquiry->to_city ?? 'غير محدد' }}</strong>
                                @else
                                    <span style="color: var(--gray);">غير محدد</span>
                                @endif
                            </td>
                            <td>{{ $inquiry->desired_date ? $inquiry->desired_date->format('Y-m-d') : 'غير محدد' }}</td>
                            <td>
                                {{ $inquiry->number_of_adults ?? 0 }} /
                                {{ $inquiry->number_of_children ?? 0 }} /
                                {{ $inquiry->number_of_babies ?? 0 }}
                            </td>
                            <td>
                                <div style="max-width: 200px; white-space: normal; font-size: 12px; color: #4A5568;">
                                    {{ $inquiry->message }}
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('admin.inquiries.updateStatus', $inquiry->id) }}" method="POST"
                                    style="display: flex; gap: 6px; align-items: center;">
                                    @csrf
                                    <select name="status"
                                        style="padding: 6px; font-size: 12px; border-radius: 4px; border: 1px solid var(--border); background-color: #fff; cursor: pointer;">
                                        <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>جديد
                                        </option>
                                        <option value="read" {{ $inquiry->status === 'read' ? 'selected' : '' }}>تم القراءة
                                        </option>
                                        <option value="responded" {{ $inquiry->status === 'responded' ? 'selected' : '' }}>تم الرد
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        style="padding: 6px 12px; font-size: 12px;">حفظ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; color: var(--gray); padding: 30px;">لا توجد طلبات حجز
                                حالياً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="pagination-container">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
@endsection