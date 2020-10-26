<template>
    <div class="calcul-history">
        <h3>Historique de calcul</h3>
        <div v-for="item in history" :key="item.date">
           {{ item.date }} à {{ item.time }} : <b>{{ item.result }}</b>
        </div>
        <div class="btn danger" @click="deleteFile" v-if="history.length > 0">Supprimer</div>

        <snackbar
            ref="snackbar"
            baseSize="100px"
            :wrapClass="''"
            :colors="{
                open: '#5cb85c',
                info: '#5bc0de',
                error: '#d9534f',
                warn: '#f0ad4e'
            }"
            :holdTime="3000"
            :multiple="false"
            position="top-right"
        />
    </div>
</template>

<script>
    export default {
        name: "CalculHistory",
        props: ['history'],
        methods: {
            deleteFile() {
                this.$http
                    .delete('/api/history')
                    .then((res) => {
                        this.history = [];
                        this.$refs.snackbar.open(res.data.message);
                    })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .calcul-history {
        padding: 35px;
        font-weight: 300;
        font-size: 18px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 3px 80px -30px rgba(13, 81, 134, 1);
        margin-left: 20px;

        h3 {
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 20px;

            &.danger {
                background-color: lighten($color: #d9534f, $amount: 30);
                color: darken($color: #d9534f, $amount: 30)
            }
        }
    }
</style>