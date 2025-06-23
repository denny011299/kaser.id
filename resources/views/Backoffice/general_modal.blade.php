<!--- modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="text-delete"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary btn-cancel" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger btn-konfirmasi">Delete</button>
        </div>
      </div>
    </div>
  </div>

{{-- Modal Konfirmasi  --}}
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Konfirmasi</h5>
      <span aria-hidden="true" class="close-konfirmasi btn-close" ></span>
    </div>
    <div class="modal-body">
      <p id="text-konfirmasi"></p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-secondary close-konfirmasi" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary btn-konfirmasi">Simpan</button>
    </div>
  </div>
</div>
</div>

{{-- Modal Verifikasi  --}}
<div class="modal fade" id="modalVerify" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Verifikasi</h5>
        
        {{-- <button type="button" data-dismiss="modal" aria-label="Close">
        </button> --}}
      </div>
      <div class="modal-body">
        <p id="text-verifikasi"></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary close-konfirmasi" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-konfirmasi">Verifikasi</button>
      </div>
    </div>
  </div>
</div>



<!-- cropper js-->
<div class="modal fade" id="crop-image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:450px" role="document">
      <div class="modal-content">
          <div class="modal-body">
              <div class="image-container">
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-success btn-sm crop-upload">
                  <i class="fa fa-cloud-upload-alt"></i> Upload
              </button>
              <button type="button" class="btn btn-danger btn-sm modal-cancel">
                  <i class="fa fa-times"></i> Cancel
              </button>
          </div>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Cropper</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
              <img id="image" src="../images/picture.jpg" alt="Picture" style="width: 100%">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>