<!DOCTYPE html>
<html>
<head>
    <title>Planet Details</title>
</head>
<body>

    <h1>Planet Details</h1>

    <div id="planet-details">
        <p>Loading...</p>
    </div>

    <a href="/planets-view">Voltar</a>

    <script>
        const planetId = "{{ $id }}";

        fetch(`/api/planets/${planetId}`)
            .then(response => response.json())
            .then(data => {
                const planet = data.data;
                const details = document.getElementById('planet-details');

                details.innerHTML = `
                    <h2>${planet.name}</h2>
                    <p><strong>Climate:</strong> ${planet.climate}</p>
                    <p><strong>Terrain:</strong> ${planet.terrain}</p>
                    <p><strong>Population:</strong> ${planet.population}</p>
                `;
            })
            .catch(error => console.error(error));
    </script>

</body>
</html>