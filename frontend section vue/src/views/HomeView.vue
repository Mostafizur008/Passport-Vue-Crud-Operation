<template>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://studybarta.files.wordpress.com/2018/04/diu-permanent-campus-ashulia.jpg" class="d-block w-100" height="450" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://parents.daffodilvarsity.edu.bd/storage/7/62021b78d75dd_owl2.jpg" class="d-block w-100" height="450" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://scontent.fdac3-2.fna.fbcdn.net/v/t1.6435-9/31895225_10156030876892203_3693798326987128832_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=300f58&_nc_eui2=AeE5lSrcaFAAky-rpVholf7_Luv46P1nYKsu6_jo_WdgqyWWFGjRuHITPg9JikXnWEFQ1pNZb-fX2Hf9LbZJ8Yxl&_nc_ohc=2KOVor7liOUAX83VHNS&_nc_ht=scontent.fdac3-2.fna&oh=00_AfC66U1VO8Ci2CETp0wXbDOVn17veT1AC9XiiCzimg6i8g&oe=65608FD2" class="d-block w-100" height="450" alt="...">
    </div>
  </div>
</div>
<div class="container py-4"></div>
</template>

<script lang="ts">
import { Options, Vue } from 'vue-class-component';

@Options({
  components: {
  },
})
export default class HomeView extends Vue {}
</script>
