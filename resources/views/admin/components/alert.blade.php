<script type="text/javascript">
    swal({
        title: "{{ $title }}",
        text: "{{ $message }}",
        type: "{{ $type }}",
        timer: {{ $timer }},
        {{ $attributes }}
    });
</script>
