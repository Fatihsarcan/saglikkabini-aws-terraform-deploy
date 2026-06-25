<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\BlockWorkTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentService
{
    public function validateAppointment(Request $request): array
    {
        return $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'date' => 'required',
            'time' => 'required',
            'service_id' => 'required',
            'team_id' => 'nullable',
        ],[
            'name.required' => __('Ad Soyad alanı zorunludur.'),
            'phone.required' => __('Telefon alanı zorunludur.'),
            'date.required' => __('Tarih alanı zorunludur.'),
            'time.required' => __('Saat alanı zorunludur.'),
            'service_id.required' => __('Hizmet alanı zorunludur.'),
            'team_id.nullable' => __('Ekibimiz alanı isteğe bağlıdır.'),
        ]);
    }

    public function formatDateTime(string $date, string $time): string
    {
        return Carbon::createFromFormat('d/m/Y', $date)
            ->format('Y-m-d') . ' ' . $time . ':00';
    }

    public function isTimeBlocked(string $dateTime, ?string $teamId): bool
    {
        // Gelen dateTime'ı Carbon nesnesine çevirelim
        $appointmentDateTime = Carbon::parse($dateTime);

        // Bloklu zamanları kontrol et
        $isBlockedTime = BlockWorkTime::where('status', 1)
            ->where(function($query) use ($appointmentDateTime, $teamId) {
                $query->where(function($q) use ($appointmentDateTime) {
                    $q->whereRaw('? BETWEEN start_time AND end_time', [$appointmentDateTime]);
                });

                if ($teamId) {
                    $query->where(function($q) use ($teamId) {
                        $q->where('team_id', $teamId)
                          ->orWhereNull('team_id');
                    });
                }
            })
            ->exists();

        // Mevcut randevuları kontrol et
        $hasExistingAppointment = Appointment::where('date', $dateTime)
            ->when($teamId, function($query) use ($teamId) {
                $query->where('team_id', $teamId);
            })
            ->exists();

        return $isBlockedTime || $hasExistingAppointment;
    }

    // Tarih formatını kontrol eden yardımcı metod ekleyelim
    private function isDateTimeOverlapping(Carbon $appointmentTime, string $blockStart, string $blockEnd): bool
    {
        $blockStartTime = Carbon::parse($blockStart);
        $blockEndTime = Carbon::parse($blockEnd);

        return $appointmentTime->between($blockStartTime, $blockEndTime);
    }

    // Debug için yardımcı metod güncellendi
    public function getBlockedTimes(?string $teamId = null): array
    {
        $blockedTimes = BlockWorkTime::where('status', 1)
            ->when($teamId, function($query) use ($teamId) {
                $query->where(function($q) use ($teamId) {
                    $q->where('team_id', $teamId)
                      ->orWhereNull('team_id');
                });
            })
            ->select(['team_id', 'start_time', 'end_time', 'status'])
            ->get()
            ->toArray();

        // Mevcut randevuları da ekleyelim
        $existingAppointments = Appointment::when($teamId, function($query) use ($teamId) {
                $query->where('team_id', $teamId);
            })
            ->select(['team_id', 'date as start_time', 'date as end_time'])
            ->get()
            ->map(function($appointment) {
                return [
                    'team_id' => $appointment->team_id,
                    'start_time' => $appointment->start_time,
                    'end_time' => $appointment->end_time,
                    'status' => 'appointment'
                ];
            })
            ->toArray();

        return array_merge($blockedTimes, $existingAppointments);
    }

    // Hata mesajını özelleştirmek için yeni metod
    public function getBlockedReason(string $dateTime, ?string $teamId): string
    {
        $appointmentDateTime = Carbon::parse($dateTime);

        // Bloklu zaman kontrolü
        $blockedTime = BlockWorkTime::where('status', 1)
            ->where(function($query) use ($appointmentDateTime, $teamId) {
                $query->whereRaw('? BETWEEN start_time AND end_time', [$appointmentDateTime]);
                if ($teamId) {
                    $query->where(function($q) use ($teamId) {
                        $q->where('team_id', $teamId)
                          ->orWhereNull('team_id');
                    });
                }
            })
            ->first();

        if ($blockedTime) {
            return __('Bu saat aralığı randevuya kapalıdır.');
        }

        // Mevcut randevu kontrolü
        $existingAppointment = Appointment::where('date', $dateTime)
            ->when($teamId, function($query) use ($teamId) {
                $query->where('team_id', $teamId);
            })
            ->first();

        if ($existingAppointment) {
            return __('Bu saatte başka bir randevu bulunmaktadır.');
        }

        return __('Seçilen tarih ve saat için randevu alınamaz.');
    }

    public function createAppointment(array $validated, string $dateTime): void
    {
        unset($validated['date']);
        $validated['date'] = $dateTime;
        Appointment::create($validated);
    }
}