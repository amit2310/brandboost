<template>
    <div style="width:100%;text-align:center;position:absolute;left:0;" v-if="isLoading">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px"
             width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;display:block;margin:0 auto;" xml:space="preserve">
    <rect x="0" y="0" width="4" height="10" fill="#333">
      <animateTransform attributeType="xml"
                        attributeName="transform" type="translate"
                        values="0 0; 0 20; 0 0"
                        begin="0" dur="0.6s" repeatCount="indefinite"/>
    </rect>
            <rect x="10" y="0" width="4" height="10" fill="#333">
      <animateTransform attributeType="xml"
                        attributeName="transform" type="translate"
                        values="0 0; 0 20; 0 0"
                        begin="0.2s" dur="0.6s" repeatCount="indefinite"/>
    </rect>
            <rect x="20" y="0" width="4" height="10" fill="#333">
      <animateTransform attributeType="xml"
                        attributeName="transform" type="translate"
                        values="0 0; 0 20; 0 0"
                        begin="0.4s" dur="0.6s" repeatCount="indefinite"/>
    </rect>
  </svg>
    </div>
</template>
<script>
    export default {
        name: 'loading',
        props: ['isLoading']
    }
</script>
<style scoped>
    svg path,
    svg rect{
        fill: #FF6700;
    }
</style>
