@extends('layouts.app')

@section('title', 'Randevu Al — ' . $doctor->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Doktorlar</a></li>
                <li class="breadcrumb-item active">Randevu Al</li>
            </ol>
        </nav>

        <div class="card shadow-sm mb-4">
            <div class="card-body d-flex align-items-center gap-3">
                <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" style="width:64px;height:64px;object-fit:cover;border-radius:50%;">
                <div>
                    <h5 class="mb-0">{{ $doctor->name }}</h5>
                    <span class="badge bg-primary">{{ $doctor->specialty }}</span>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h5 class="mb-4"><i class="bi bi-calendar3"></i> Tarih ve Saat Seçin</h5>

                <form id="bookingForm" method="POST" action="{{ route('appointments.store') }}">
                    @csrf
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                    <input type="hidden" name="time_slot_id" id="selectedSlotId">

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tarih</label>
                        <input type="date"
                               id="slotDate"
                               class="form-control"
                               min="{{ now()->addDay()->format('Y-m-d') }}"
                               max="{{ now()->addDays(30)->format('Y-m-d') }}"
                               required>
                    </div>

                    <div class="mb-4" id="slotsContainer" style="display:none;">
                        <label class="form-label fw-semibold">Müsait Saatler</label>
                        <div id="slotButtons" class="d-flex flex-wrap gap-2"></div>
                        <div id="noSlots" class="text-muted small mt-2" style="display:none;">
                            <i class="bi bi-calendar-x"></i> Bu tarihte müsait saat yok.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Not (isteğe bağlı)</label>
                        <textarea name="notes" class="form-control" rows="2" maxlength="500"
                                  placeholder="Şikayetiniz veya eklemek istediğiniz bilgi..."></textarea>
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary w-100" disabled>
                        <i class="bi bi-check-circle"></i> Randevuyu Onayla
                    </button>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const doctorId = {{ $doctor->id }};
const dateInput = document.getElementById('slotDate');
const slotsContainer = document.getElementById('slotsContainer');
const slotButtons = document.getElementById('slotButtons');
const noSlots = document.getElementById('noSlots');
const selectedSlotId = document.getElementById('selectedSlotId');
const submitBtn = document.getElementById('submitBtn');

dateInput.addEventListener('change', async function() {
    const date = this.value;
    if (!date) return;

    slotButtons.innerHTML = '<span class="text-muted small"><i class="bi bi-hourglass-split"></i> Yükleniyor...</span>';
    slotsContainer.style.display = 'block';
    noSlots.style.display = 'none';
    selectedSlotId.value = '';
    submitBtn.disabled = true;

    try {
        const resp = await fetch(`/slots/${doctorId}?date=${date}`, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });
        const json = await resp.json();
        const slots = json.data || [];

        slotButtons.innerHTML = '';

        if (slots.length === 0) {
            noSlots.style.display = 'block';
            return;
        }

        slots.forEach(slot => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-outline-primary btn-sm';
            btn.textContent = slot.slot_time.substring(0, 5);
            btn.dataset.slotId = slot.id;
            btn.addEventListener('click', function() {
                document.querySelectorAll('#slotButtons .btn').forEach(b => b.classList.remove('btn-primary', 'active'));
                document.querySelectorAll('#slotButtons .btn').forEach(b => b.classList.add('btn-outline-primary'));
                this.classList.remove('btn-outline-primary');
                this.classList.add('btn-primary', 'active');
                selectedSlotId.value = this.dataset.slotId;
                submitBtn.disabled = false;
            });
            slotButtons.appendChild(btn);
        });
    } catch(e) {
        slotButtons.innerHTML = '<span class="text-danger small">Hata oluştu, lütfen tekrar deneyin.</span>';
    }
});
</script>
@endpush
