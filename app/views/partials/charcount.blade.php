<!-- Show text area character count left -->
<script>
  function countChar(val, max) {
    var len = val.value.length;
    if (len > max) {
      val.value = val.value.substring(0, max);
    } else {
      $('#charnum').text(max - len);
    }
  };
</script>