<script type="text/javascript">
  function confirmDelete (id) {
    if (confirm("Really delete user?")) {
      window.location.href = "http://"+window.location.hostname+"/deleteuser/"+id;
    }
  }
</script>
