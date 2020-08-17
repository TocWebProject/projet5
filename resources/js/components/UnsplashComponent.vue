<template>
    <div class="container">
        <h3 class="text-center mt-3 mb-3">Trouver l'inspiration avec Unsplash</h3>
        <div class="button-wrapper d-flex justify-content-center">
            <div class="row">
                <div class="input-group">
                    <input
                        v-model="unsplashQuery"
                        v-on:keyup.enter="onEnter"
                        type="text"
                        label="search term"
                        placeholder="Inspiration"
                        class="form-control"
                        aria-label="Recipient's topic" 
                        aria-describedby="basic-addon2"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" @click="searchUnsplash('')">Chercher</button>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="alert alert-dark no-result text-center mt-3" v-show="noResult">
            Aucune image ne correspond à votre recherche
        </div>
        <div class="unsplash-img">
            <div v-for="(image, i) in images" :key="i" >
                <div class="gallery-container">
                    <div class="gallery-item">
                        <div class="image">
                            <img :src="image.urls.regular" :alt="image.alt_description" />
                            <div class="text">
                                <a :href="image.user.links.html" target="_blank">© {{ image.user.name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>            
    </div>
</template>

<script>

    export default {

        data: () => ({
            noResult: false,
            images: [],
            unsplashQuery: localStorage.unsplashQuery,
        }),


        methods: {
            searchUnsplash(unsplashQuery) {
                this.images = [];
                axios
                .get(
                `https://api.unsplash.com/search/photos?query=${this.unsplashQuery}&per_page=21`,
                {
                    headers: {
                    Authorization:
                        "Client-ID YXdpxoIybZ6W2NPqmou2ciz_pBaEEKef1yQ2zh-mGtA",
                        "Accept-Version": "v1"
                        }
                }
                    )
                .then(response => {
                    this.images = response.data.results;
                    if(!this.images.length){
                        this.noResult = true
                    }else{
                        this.noResult = false
                    }
                    })
                .catch(error => console.log(error));
            },

            onEnter: function(){
               this.searchUnsplash(this.unsplashQuery) 
            },
                
        },

        mounted() {
        if (localStorage.unsplashQuery) {
            this.unsplashQuery = localStorage.unsplashQuery;
            }
        },
        watch: {
            unsplashQuery(newUnsplashSearch) {
            localStorage.unsplashQuery = newUnsplashSearch;
            }
        },

        beforeMount(){
            this.noResult = false
            if (this.unsplashQuery){
                this.searchUnsplash(this.unsplashQuery)
            } 
         },

    
};

</script>

<style scoped>

    .container {
    width: auto;
    margin: 0 auto;
    }

    .unsplash-img{
        text-align: center;
        display: grid;
        grid-template-columns: repeat(2, 300px) fit-content(40%);
        grid-gap: 35px;
        margin-bottom: 40px;
    }

    .gallery-item{
        width:100%;
        height:100%;
        position:relative;
    }

    .gallery-item .image{
        width:100%;
        height:100%;
        overflow:hidden;
    }

    .gallery-item .image img{
        width:100%;
        height:100%;
        object-fit: cover;
        object-position:50% 50%;
        transition:.5s ease-in-out;
    }
    .gallery-item:hover .image img{
        transform:scale(1.1);
    }

    .gallery-item .text a{
        opacity:0;
        position:absolute;
        top:85%;
        left:50%;
        transform:translate(-50%,-50%);
        color:#fff;
        font-size:13px;
        z-index:4;
        transition: .3s ease-in-out;
        -webkit-backdrop-filter: blur(1.5px) saturate(1.1);
        backdrop-filter: blur(1.5px) saturate(1.1);
    }

    .gallery-item:hover .text a{
        opacity:1;
        animation: move-down .4s linear;
        padding:1em;
        width:100%;
    }

    .w-1{
        grid-column: span 1;
    }
    .w-2{
        grid-column: span 2;
    }
    .w-3{
        grid-column: span 3;
    }
    .w-4{
        grid-column: span 4;
    }
    .w-5{
        grid-column: span 5;
    }
    .w-6{
        grid-column: span 6;
    }

    .h-1{
        grid-row: span 1;
    }
    .h-2{
        grid-row: span 2;
    }
    .h-3{
        grid-row: span 3;
    }
    .h-4{
        grid-row: span 4;
    }
    .h-5{
        grid-row: span 5;
    }
    .h-6{
        grid-row: span 6;
    }




    @media screen and (max-width:770px){
        .unsplash-img{
            grid-template-columns: repeat(1,1fr);
        }
        .w-1,.w-2,.w-3,.w-4,.w-5,.w-6{
            grid-column:span 1;
        }
    }


    @keyframes move-down{

        0%{
            top:60%;
        }
        50%{
            top:75%;
        }
        100%{
            top:85%;
        }
    }

    

</style>