document.addEventListener('DOMContentLoaded', () => {
    const lookupButton = document.getElementById('lookup');
    const resultDiv = document.getElementById('result');

    lookupButton.addEventListener('click', () => {
       const xhr = new XMLHttpRequest();
       const countryInput = document.getElementById('country').value.trim(); // Get the country input value

        if (countryInput) {
            const url = `world.php?country=${encodeURIComponent(countryInput)}`;

            xhr.open('GET', url, true); 

           xhr.onreadystatechange = function () {
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
