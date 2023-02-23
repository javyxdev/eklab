<!-- Modal Plantilla Examen Hemograma -->
<div class="modal fade" id="exmHemograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloHematologia"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('admin.ordens.pl_hemograma_form')
        </div>
    </div>
</div>
