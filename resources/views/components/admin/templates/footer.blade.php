      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; LaporinAjaYuk - Aplikasi Pelaporan Pengaduan Masyarakat {{ date('Y') }}</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik Tombol Logout Jika Yakin Ingin Logout.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-success" href="{{ route('petugas_logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets') }}/admin/vendor/jquery/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{ asset('assets') }}/admin/js/sb-admin-2.min.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/chart.js/Chart.min.js"></script>
  <script src="{{ asset('assets') }}/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="{{ asset('assets') }}/admin/js/demo/chart-area-demo.js"></script>
  <script src="{{ asset('assets') }}/admin/js/demo/chart-pie-demo.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @stack('javascript')
</body>
</html>