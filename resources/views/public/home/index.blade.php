@extends('public.layouts.app')
@section('content')
This is frontend
@endsection


@push('script')
  <script>
    alert(1);
</script>  
@endpush