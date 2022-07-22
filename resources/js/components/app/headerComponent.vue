<template>
    <div class="btn-group">
    <button type="button" class="btn dropdown-toggle text-light" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">{{ this.$store.state.userName }}</button>
    <ul class="dropdown-menu text-center" style="">
      <li><a class="dropdown-item" href="/logout">Выйти</a></li>
    </ul>
  </div>
</template>

<script>

</script>

<style>

</style>