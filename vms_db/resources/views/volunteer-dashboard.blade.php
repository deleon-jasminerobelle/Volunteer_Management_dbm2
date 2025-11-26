<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Volunteer Dashboard</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div id="volunteer-dashboard"></div>

  <script>
    window.__VOLUNTEER_DASHBOARD_DATA__ = {
      volunteer: {!! json_encode($volunteer) !!},
      polls: {!! json_encode($polls) !!}
    };
    window.csrfToken = "{{ $csrf }}";
  </script>
</body>
</html>