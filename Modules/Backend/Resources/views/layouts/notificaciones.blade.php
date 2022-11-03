<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



@if(Session::has('success'))
<script>
swal({
  title: "Éxito!",
  text: "{{ Session::get('success') }}",
  icon: "success",
  button: false,
  timer: 2000,
});
</script>  
@endif
@if(Session::has('info'))
<script>
  swal({
  title: "Ups!",
  text: "{{ Session::get('info') }}",
  icon: "info",
  button: false,
  timer: 4000,
});
</script>  
  @endif
  @if(Session::has('error'))
<script>
  swal({
  title: "Error!",
  text: "{{ Session::get('error') }}",
  icon: "error",
  button: false,
  timer: 4000,
});
</script>  
  @endif


