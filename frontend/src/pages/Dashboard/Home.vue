<script setup>
    import { ref } from "vue";
    import ConsultationCard from '@/components/util/ConsultationCard.vue'

    const carousel = ref(null);

    const scrollNext = () => {
        if (carousel.value) {
            carousel.value.scrollBy({ left: 300, behavior: "smooth" });
        }
    };

    const scrollPrev = () => {
        if (carousel.value) {
            carousel.value.scrollBy({ left: -300, behavior: "smooth" });
        }
    };
</script>
<template>
    <div class="flex flex-col gap-3">
        <div class="rounded-xl py-5 h-full backdrop-blur-[8px] bg-[#FFFC]">
            <div class="flex flex-col w-full gap-3 h-full">
                <div class="flex flex-col gap-2 p-5 pt-2">
                    <p class="font-semibold tracking-wide text-slate-400">KONSULTASI</p>
                    <h1 class="text-3xl font-bold tracking-tight text-darkTeal">Cek jadwal konsultasi anda disini.</h1>
                </div>

                <div class="relative w-full px-5 h-full">
                    <!-- Carousel Container -->
                    <div ref="carousel" class="flex scroll-smooth snap-x snap-mandatory overflow-hidden h-full">
                        <div class="flex-shrink-0 w-1/2 h-full text-white flex items-center justify-center text-2xl snap-start px-2">
                            <ConsultationCard />
                        </div>
                        <div class="flex-shrink-0 w-1/2 h-full text-white flex items-center justify-center text-2xl snap-start px-2">
                            <ConsultationCard />
                        </div>
                        <div class="flex-shrink-0 w-1/2 h-full text-white flex items-center justify-center text-2xl snap-start px-2">
                            <ConsultationCard />
                        </div>
                        <div class="flex-shrink-0 w-1/2 h-full text-white flex items-center justify-center text-2xl snap-start px-2">
                            <ConsultationCard />
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <button @click="scrollPrev" class="absolute left-0 ml-2 top-1/2 -translate-y-1/2 bg-darkTeal text-white rounded-full w-[2.5vw] h-[2.5vw]">
                        <div class="flex items-center justify-center">
                            <fa icon="fas fa-chevron-left" class="text-md" fixed-width></fa>
                        </div>
                    </button>

                    <button @click="scrollNext" class="absolute right-0 mr-2 top-1/2 -translate-y-1/2 p-2 bg-gray-800 text-white rounded-full  w-[2.5vw] h-[2.5vw]">
                        <div class="flex items-center justify-center">
                            <fa icon="fas fa-chevron-right" class="text-md" fixed-width></fa>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</template>