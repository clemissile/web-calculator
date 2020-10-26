<template>
    <div class="container">
        <Calculator @newStore="toHistory" />
        <CalculHistory :history="history" />
    </div>
</template>

<script>
    import Calculator from "../components/Calculator.vue"
    import CalculHistory from "../components/CalculHistory.vue"

    export default {
        name: "Home",
        data() {
            return {
                history: []
            }
        },
        components: {
            Calculator,
            CalculHistory
        },
        created() {
            this.toHistory();
        },
        methods: {
            toHistory() {
                this.$http
                    .get('/api/history')
                    .then((res) => {
                        this.history = res.data;
                    });
            }
        }
    }
</script>

<style lang="scss" scoped></style>
