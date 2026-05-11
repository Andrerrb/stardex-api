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

                data.data.forEach((planet, index) => {
                    const li = document.createElement('li');
                    const link = document.createElement('a');

                    const planetId = index + 1;

                    link.href = `/planets-view/${planetId}`;
                    link.textContent = planet.name + " - " + planet.climate;

                    li.appendChild(link);
                    list.appendChild(li);
                });
            })
            .catch(error => console.error(error));
    </script>

</body>
</html>