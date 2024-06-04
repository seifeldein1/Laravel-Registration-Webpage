const apiKey = 'c58d7abfeamshcda1a331fbbed15p1eadbdjsnf7297a5b9341';
const apiHost = 'imdb8.p.rapidapi.com';
async function getActorData(actorUrl) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', actorUrl);
        xhr.setRequestHeader('X-RapidAPI-Key', apiKey);
        xhr.setRequestHeader('X-RapidAPI-Host', apiHost);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                const result = JSON.parse(xhr.responseText);
                resolve(result.data?.name?.nameText?.text);
            } else {
                reject('Request failed with status:', xhr.status, xhr.statusText);
            }
        };
        xhr.onerror = function () {
            reject('Request failed:', xhr.statusText);
        };
        xhr.send();
    });
}

async function getActorsData(listOfActors) {
    const url = 'https://imdb8.p.rapidapi.com/actors/v2/get-bio?nconst=';
    const actorPromises = listOfActors.map(async function(actorId) {
        const actorUrl = url + actorId;
        return await getActorData(actorUrl);
    });

    return await Promise.all(actorPromises);
}

function listActors() {
    const userBirthDate = new Date(birthday.value);
    const day = userBirthDate.getDate().toString().padStart(2, '0');
    const month = (userBirthDate.getMonth() + 1).toString().padStart(2, '0');
    const apiUrl = `https://imdb8.p.rapidapi.com/actors/v2/get-born-today?today=${month}-${day}&first=5`;

    const xhr = new XMLHttpRequest();
    xhr.open('GET', apiUrl);
    xhr.setRequestHeader('X-RapidAPI-Key', apiKey);
    xhr.setRequestHeader('X-RapidAPI-Host', apiHost);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            const data = JSON.parse(xhr.responseText);
            const listOfActors = data.data?.bornToday?.edges?.map(actor => actor?.node?.id);
            getActorsData(listOfActors)
                .then(
                    actorsData => {
                        alert(actorsData.join('\n'));
                    })
                .catch(error => {
                    alert(error);
                });
        }
    };
    xhr.onerror = function () {
        alert('Request failed:', xhr.statusText);
    };
    xhr.send();
}
