document.addEventListener('DOMContentLoaded', () => {
    const lookupCountryButton = document.getElementById('lookup');
    const lookupCitiesButton = document.getElementById('lookupCities');
    const resultDiv = document.getElementById('result');

    lookupCountryButton.addEventListener('click', () => {
        const countryInput = document.getElementById('country').value.trim();

        if (countryInput) {
            const url = `world.php?country=${encodeURIComponent(countryInput)}`;
            const xhr = new XMLHttpRequest();

            xhr.open('GET', url, true);

            xhr.onreadystatechange = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resultDiv.innerHTML = xhr.responseText;
                    } else {
                        resultDiv.innerHTML = `<p class="error">Error: ${xhr.status} ${xhr.statusText}</p>`;
                    }
                }
            };

            xhr.send();
        } else {
            resultDiv.innerHTML = `<p class="error">Please enter a country name.</p>`;
        }
    });

    lookupCitiesButton.addEventListener('click', () => {
        const countryInput = document.getElementById('country').value.trim();

        if (countryInput) {
            const url = `world.php?country=${encodeURIComponent(countryInput)}&lookup=cities`;
            const xhr = new XMLHttpRequest();

            xhr.open('GET', url, true);

            xhr.onreadystatechange = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resultDiv.innerHTML = xhr.responseText;
                    } else {
                        resultDiv.innerHTML = `<p class="error">Error: ${xhr.status} ${xhr.statusText}</p>`;
                    }
                }
            };

            xhr.send();
        } else {
            resultDiv.innerHTML = `<p class="error">Please enter a country name.</p>`;
        }
    });
});
