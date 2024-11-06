<script>
import HeroSection from './HeroSection.vue'
import Navbar from './Navbar.vue'
import { Head } from '@inertiajs/vue3';

  export default {
    components: {
        Navbar,
        HeroSection,
        Head
    },
  };
  </script>
<template>
  <Head title="Welcome" />
  <div>
        <Navbar />
        <HeroSection />
        <!-- Other components or sections -->
    </div>
</template>


<style scoped>

</style>