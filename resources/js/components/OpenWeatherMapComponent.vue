<template>
    <div id="weather" class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">Météo</div>

            <div class="card-body align-middle text-center">
        
                <div class="weather-wrap" v-if="typeof weather.main != 'undefined'">
                    <div class="location-box">
                        <div class="location">{{ weather.name }}, {{ weather.sys.country }}</div>
                        <div class="date">{{ dateBuilder() }}</div>
                    </div>
                    <div class="weather-box">
                        <div class="icon"><img :src="`http://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png`" alt="weather icon"></div>
                        <div class="d-flex justify-content-center">
                            <p class="temp mr-3">{{ Math.round(weather.main.temp) }}°c</p>
                            <p class="weather">{{ weather.weather[0].description }}</p>
                        </div>
                        <div class="d-flex justify-content-center"> 
                            <p class="temp-min mr-3">Min: {{ Math.round(weather.main.temp_min) }}°c</p>
                            <p class="temp.max">Max: {{ Math.round(weather.main.temp_max) }}°c</p>
                        </div>
                    </div>
                </div>
                <div class="button-wrapper d-flex justify-content-center">
                    <div class="row">
                        <div class="input-group text-center">
                            <input
                            v-model="cityQuery"
                            v-on:keyup.enter="fetchWeather"
                            type="text"
                            class="form-control" 
                            placeholder="Votre Ville"
                            aria-label="Recipient's search weather"
                            /> 
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" @click="fetchWeather('')"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-dark no-result text-center mt-3" v-show="noCity">
                    Ville Inconnue
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'weather',
    data() {
        
        return {
            
            noCity: false,
            api_key: '9acc0fa70a651d74c716faca6c3bc992',
            url_base: 'https://api.openweathermap.org/data/2.5/',
            cityQuery: localStorage.cityQuery,
            weather: {},
            
    
        }

    },
    
    methods:{
        fetchWeather () {
            
            fetch(`${this.url_base}weather?q=${this.cityQuery}&units=metric&APPID=${this.api_key}&lang=fr`)
            .then(response => {
                if (!response.ok) {
                    this.noCity = true
                }else{
                    this.noCity = false
                }
                    return response.json();
            }).then(this.setResults);
            
        },
        setResults(results) {
            this.weather = results;
        },
        dateBuilder () {
            let d = new Date();
            let months = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];
            let days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
            let day = days[d.getDay()];
            let date = d.getDate();
            let month = months[d.getMonth()];
            let year = d.getFullYear();
            return `${day} ${date} ${month} ${year}`;
        },
         
    },

    mounted() {
        if (localStorage.cityQuery) {
            this.cityQuery = localStorage.cityQuery;
        }
    },
    watch: {
        cityQuery(newCity) {
        localStorage.cityQuery = newCity;
        }
    },

    beforeMount(){
        if (this.cityQuery){
        this.fetchWeather(this.cityQuery);
        }
    },
}

</script>