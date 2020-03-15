<template>
    <div class="system-message alert alert-danger" role="alert" v-if="error">
        <button @click.stop="clearMessage()" class="close">&times;</button>
        <p>{{ error }}</p>
    </div>
</template>
<script>
    export default {
        name: 'error-message',
        props: ['error'],
        methods: {
            clearMessage : function () {
                this.error = '';
            }
        }
    }
</script>
