<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Upload a new image
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <form action="{{ route('upload') }}"
              method="post"
              enctype="multipart/form-data"
              class="modal-content"
        >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Upload a new image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @section('currentRoute')
                    {{ Form::hidden('route', 'home') }}
                @show
                @csrf
                <input type="file" name="image" value="image" id="image">
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Upload image">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
