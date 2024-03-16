<template>
  <div class="loading-container" v-show="this.$store.state.loading" >
    <div class="waterfall">
      <div id="first">
        <i class="fa-solid fa-helmet-safety"></i>
      </div>
      <div id="second">
        <i class="fa-solid fa-industry"></i>
      </div>
      <div id="third">
        <i class="fa-solid fa-gear"></i>
      </div>
      <div id="fourth">
        <i class="fa-solid fa-user-shield"></i>
      </div>
      <div id="fifth">
        <i class="fa-solid fa-screwdriver-wrench"></i>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PaginateVue'
}
</script>

<style>
@-webkit-keyframes waterfall {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-250%);
            transform: translateY(-250%); }
  40%,
  60% {
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0); }
  100% {
    opacity: 0;
    -webkit-transform: translateY(250%);
            transform: translateY(250%); }
}
@keyframes waterfall {
  0% {
    opacity: 0;
    -webkit-transform: translateY(-250%);
            transform: translateY(-250%); }
  40%,
  60% {
    opacity: 1;
    -webkit-transform: translateY(0);
            transform: translateY(0); }
  100% {
    opacity: 0;
    -webkit-transform: translateY(250%);
            transform: translateY(250%); }
}
.loading-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.566);
  z-index: 1000;
  display: flex;
  justify-content: center;
  align-items: center;
}
.waterfall div {
  -webkit-animation: waterfall 1.5s infinite;
    animation: waterfall 1.5s infinite;
  height: 20px;
  color: rgba(255, 255, 255, 0.802);
  left: 50%;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  width: 20px;
  font-size: 25px;
}
  .waterfall #fifth {
    -webkit-animation-delay: 1.25s;
            animation-delay: 1.25s;
    margin-left: -90px;
  }
  .waterfall #first {
    -webkit-animation-delay: 0.25s;
            animation-delay: 0.25s;
    margin-left: -50px;
  }
  .waterfall #fourth {
    -webkit-animation-delay: 1s;
            animation-delay: 1s;
    margin-left: -15px;
  }
  .waterfall #second {
    -webkit-animation-delay: 0.5s;
            animation-delay: 0.5s;
    margin-left: 25px;
  }
  .waterfall #third {
    -webkit-animation-delay: 0.75s;
            animation-delay: 0.75s;
    margin-left: 60px;
  }
</style>
