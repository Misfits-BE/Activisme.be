<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Zoek een activiteit</h5>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="search" method="GET" action="{{ route('admin.logs.search') }}">
                    {{ csrf_field() }} {{-- Form field protection --}}

                    <div class="form-group row">
                        <div class="col-lg-12">
                             <input type="text" placeholder="De zoekterm" name="term" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="search" class="btn btn-sm btn-secondary">
                    <i class="fa fa-search"></i> Zoek
                </button>

                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <i class="fa fa-close"></i> Annuleren
                </button>
            </div>
        </div>
    </div>
</div>