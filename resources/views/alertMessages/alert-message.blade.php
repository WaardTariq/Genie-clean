@if (session('modal-success') || session('modal-danger') || $errors->any())
<div class="modal fade" id="flashAlertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content {{ session('modal-success') ? 'bg-primary' : 'bg-danger' }} text-white text-center">
            <div class="modal-body p-5">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold mb-2">
                    {{ session('modal-success') ? 'Well Done!' : 'Oops!' }}
                </h4>
                <p class="mb-4">
                    @if ($errors->any())
                    <ul class="text-start mb-0 px-3">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @else
                    {{ session('modal-success') ?? session('modal-danger') }}
                    @endif
                </p>
                <button type="button" class="btn btn-light px-4 fw-bold" data-bs-dismiss="modal">
                    Ok
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        const modal = new bootstrap.Modal(document.getElementById('flashAlertModal'));
        modal.show();
    });

</script>
@endif
