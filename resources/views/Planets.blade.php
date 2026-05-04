<!DOCTYPE html>
<html>
<head>
    <title>Planets</title>
</head>
<body>

    <h1>Planets</h1>

    <ul id="planets-list"></ul>

    <script>
        fetch('/api/planets')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('planets-list');

                data.data.forEach(planet => {
                    const li = document.createElement('li');
                    li.textContent = planet.name + " - " + planet.climate;
                    list.appendChild(li);
                });
            })
            .catch(error => console.error(error));
    </script>

</body>
</html>