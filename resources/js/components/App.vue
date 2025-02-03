<template>
    <div class="container">
        <h1 class="text-center">Skracanie Linków</h1>
        
        <div class="input-group">
            <input type="text" v-model="url" class="form-control" placeholder="Wprowadź URL">
            <button @click="createShortLink" class="btn btn-primary">Skróć</button>
        </div>

        <div v-if="shortLink">
            <p>Skrócony link: <a :href="shortLink" target="_blank">{{ shortLink }}</a></p>
        </div>

        <h2>Lista linków:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Oryginalny URL</th>
                    <th>Skrócony URL</th>
                </tr>
                <button @click="fetchLinks" class="btn btn-primary">Odśwież historię</button>

            </thead>
            <tbody>
                <tr v-for="link in links" :key="link.id">
                    <td>{{ link.original_url }}</td>
                    <td><a :href="link.short_code" target="_blank">{{ link.short_code }}</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            url: '',
            shortLink: null,
            links: [],
            baseURL: window.location.origin + '/'
        };
    },
    methods: {
        async createShortLink() {
            if (!this.url) return alert("Podaj poprawny URL!");

            try {
                const response = await axios.post('/links', { original_url: this.url });
                this.shortLink = response.data.short_code;
                this.fetchLinks();
            } catch (error) {
                alert("Błąd przy skracaniu linku!");
            }
        },
        async fetchLinks() {
            try {
                const response = await axios.get('/links');
                this.links = response.data;
                console.log("Pobrane linki:", this.links);
            } catch (error) {
                console.error("Błąd pobierania linków:", error);
            }
        }
    },
    mounted() {
        this.fetchLinks();
    }
};
</script>

<style>
.container {
    max-width: 600px;
    margin: 20px auto;
}
.input-group {
    margin-bottom: 20px;
}
div {
    border: 1px black;
}
</style>
