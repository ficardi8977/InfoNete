const API_KEY = '270d6118e9075a33fff36b379473cca2';

const fetchData = position =>{
    const { latitude, longitude } = position.coords;
    fetch(`https://api.openweathermap.org/data/2.5/weather?units=metric&lang=sp&lat=${latitude}&lon=${longitude}&appid=${API_KEY}`)
        .then(response => response.json())
        .then(data => setWeatherData(data));
}

const setWeatherData = data =>{
    console.log(data);
    const weatherData = {
        location: data.name,
        description: getDescription(data.weather[0].description),
        humidity: getHumidity(data.main.humidity),
        pressure: getPressure(data.main.pressure),
        temperature: getTemp(data.main.temp),
        icon: data.weather[0].icon,
        visibility: getVisibility(data.visibility),
        wind: getWind(data.wind.speed),
    }

    Object.keys(weatherData).forEach(key => {
        if(key == 'icon'){
            getIconWeather(weatherData[key]);
        }else{
            document.getElementById(key).textContent = weatherData[key];
        }
    });

    cleanUp();
}

const cleanUp = () =>{
    let bar = document.getElementById('bar');
    let loader = document.getElementById('loader');

    loader.style.display = 'none';
    bar.style.display = 'block';
}

const getDescription = description =>{
    return description[0].toUpperCase() + description.substring(1);
}

const getHumidity = humidity =>{
    return 'Humedad: ' + humidity + '%';
}

const getPressure = pressure =>{
    return 'Presión: ' + pressure + ' mbar';
}

const getTemp = temp =>{
    return Math.trunc(temp) + ' °C';
}

const getIconWeather = weatherKey =>{
    const contenedor = document.getElementById("iconWeather");
    contenedor.insertAdjacentHTML(
        "beforeend",
        `<img src='http://openweathermap.org/img/wn/${weatherKey}@2x.png' alt='Icono del clima' style="width: 94px;height: 94px">`
    );
}

const getVisibility = visibility =>{
    let visibilityKm = Math.round(visibility / 1000);
    return 'Visibilidad: ' + visibilityKm + ' Km';
}

const getWind = wind =>{
    let windKm = Math.round(wind * 3.6);
    return 'Viento: ' + windKm + ' Km/h';
}


const onload = () =>{
    navigator.geolocation.getCurrentPosition(fetchData);
}