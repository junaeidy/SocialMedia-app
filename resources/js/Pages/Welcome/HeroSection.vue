<template>
  <section class="relative bg-gray-900 text-white h-screen pt-20 flex items-center justify-center dark:bg-gray-800 dark:text-gray-200">
    <div class="container">
      <div class="relative h-full w-full overflow-hidden justify-center">
        <div v-for="(slide, index) in slides" :key="index" :class="['slide', index === currentSlide ? 'block' : 'hidden']">
          <div class="flex flex-col justify-center items-center h-full text-center px-4">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">{{ slide.title }}</h1>
            <p class="text-lg md:text-xl lg:text-2xl font-light mb-8">{{ slide.description }}</p>
          </div>
        </div>
      </div>

      <div class="absolute bottom-24 left-1/2 transform -translate-x-1/2 flex space-x-4">
        <button v-for="(slide, index) in slides" :key="index" @click="showSlide(index)"
          :class="['w-3 h-3 rounded-full', currentSlide === index ? 'bg-white' : 'bg-white opacity-50 hover:opacity-100 dark:bg-gray-200 dark:hover:bg-white']"></button>
      </div>
    </div>
  </section>
</template>

<script>
    export default {
    name: "HeroSection",
    data() {
        return {
            currentSlide: 0,
            slides: [
                {
                    title: "",
                    description: "Selamat datang di Forum Discussy, tempat di mana Birokrasi, Dosen dan mahasiswa dari berbagai jurusan dapat saling bertukar informasi, berinteraksi, berbagi pengetahuan, dan mendiskusikan topik-topik menarik. Di sini, Kamu dapat bertemu dengan sesama mahasiswa yang memiliki minat dan passion yang sama, serta mendapatkan wawasan baru dari perspektif yang beragam. Bergabunglah sekarang dan jadilah bagian dari komunitas yang aktif dan bersemangat dalam berdiskusi!",
                },
                {
                    title: "",
                    description: "Discussy adalah sebuah platform diskusi online yang didedikasikan untuk Birokrasi dan mahasiswa dari berbagai jurusan dan latar belakang. Discussy percaya bahwa diskusi adalah kunci untuk pertumbuhan intelektual dan pengembangan pribadi. Melalui website Discussy, Discussy menyediakan ruang yang aman dan terbuka bagi mahasiswa untuk berbagi ide, pemikiran, dan pandangan mereka tentang berbagai topik.",
                },
                {
                    title: "",
                    description: "Discussy berkomitmen untuk menciptakan lingkungan yang inklusif, di mana setiap suara dihargai dan dihormati. Bergabunglah dengan Discussy dan jadilah bagian dari komunitas Mahasiswa yang bersemangat dalam berdiskusi dan saling belajar!",
                },
            ],
        };
    },
    methods: {
        showSlide(index) {
            this.currentSlide = index;
        },
    },
    mounted() {
        setInterval(() => {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        }, 10000);
    },
};
</script>

<style scoped>
    .slide {
        background-size: cover;
        background-position: center;
    }
</style>