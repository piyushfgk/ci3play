<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <img src="<?= base_url('bs_icons/badge-hd-fill.svg') ?>" alt="" width="32" height="32" title="Bootstrap">
    <span class="text-muted">Play with <a href="https://v5.getbootstrap.com/">Bootstrap 5</a> &amp; <a href="https://codeigniter.com/userguide3/index.html">Codeigniter</a>  v <?= CI_VERSION ?> &copy; <?= "2020-".date('Y') ?></span>
  </div>
</footer>
<script src="https://kit.fontawesome.com/d4ddcae7a9.js" crossorigin="anonymous"></script>
<!-- Popper.js first, then Bootstrap JS -->
<script src="<?= base_url('js/popper.min.js') ?>" ></script>
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script>
  /**Enabling bootstrap tooltip everwhere */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
  /** */
</script>
</body>
</html>