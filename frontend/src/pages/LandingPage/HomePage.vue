<script setup>
    import { onMounted } from 'vue'
    import { initFlowbite } from 'flowbite'

    // initialize components based on data attribute selectors
    onMounted(() => {
        initFlowbite();
    })
</script>

<template>
    <div class="flex w-full bg-white px-16 pt-16 pb-32 gap-10 items-center justify-between">
        <div class="w-5/12">
            <h1 class="text-5xl font-bold leading-relaxed text-darkTeal tracking-tight">
                Jelajahi Dirimu dan Temukan Kesejahteraan Mentalmu Bersama <span class="text-skyBlue">Luminds!</span>
            </h1>
            <p class="leading-loose text-gray-500">Menghadapi tantangan mental adalah langkah penting menuju kesejahteraan diri. Di sini, kami mendukungmu untuk berani menghadapi ketakutan dan menjelajahi kedalaman dirimu.</p>

            <div class="flex w-full justify-end mt-10">
                <div class="flex items-end justify-between gap-3">
                    <p class="font-semibold text-xl">Mulai konsultasi</p>
                    <fa icon="fas fa-circle-arrow-up" class="text-goldenYellow" fixed-width size="2x" transform="rotate-45"></fa>
                </div>
            </div>
        </div>
        <div class="w-7/12 flex gap-5">
            <div class="w-1/2">
                <img src="@/assets/img/header1.jpg" class="rounded-3xl">
            </div>
            <div class="flex flex-col w-1/2 gap-5">
                <img src="@/assets/img/header2.jpg" class="h-full rounded-3xl object-cover">
                <!-- <div class="flex flex-col justify-center bg-mocca px-8 rounded-2xl h-1/2 gap-3">
                    <h1 class="font-semibold text-7xl text-beige">100+</h1>
                    <p class="text-beige font-medium text-2xl">Kasus telah selesai</p>
                </div> -->
            </div>
        </div>
    </div>

    <div class="flex flex-col w-full bg-beige px-16 py-32 gap-10 items-center justify-center h-screen">
        <div class="flex flex-col gap-3" >
            <p class="font-semibold tracking-wide text-mocca">SIAPA KAMI</p>
            <h1 class="text-4xl font-bold tracking-tight text-bean">Solusi untuk semua masalah mental anda.</h1>
        </div>

        <img class="w-full h-4/6 object-cover object-center rounded-3xl" src="@/assets/img/header3.jpg">
        <p class="text-justify leading-relaxed font-medium text-xl tracking-tight">Di Luminds, setiap cerita adalah bagian dari perjalananmu yang berharga. Kami hadir untuk mendukungmu—tanpa penilaian, hanya solusi yang sederhana, tulus, dan penuh empati. Di sini, kamu tidak hanya menemukan dirimu, tetapi juga merasakan kehadiran kami yang sepenuhnya mendengarkan dan memahami. Temukan ruangmu untuk berbagi, dan rasakan bagaimana setiap suara dihargai dan setiap perasaan dipahami.</p>
    </div>

    <div class="flex w-full bg-white px-16 py-32 gap-10 items-center justify-between">
        <div class="flex w-1/2 gap-3">
            <div class="flex w-1/2 flex-col gap-3">
                <img class="w-full h-1/2 object-cover object-center rounded-3xl" src="@/assets/img/header5.jpg">
                <img class="w-full h-1/2 object-cover object-center rounded-3xl" src="@/assets/img/header6.jpg">
            </div>
            <img class="w-1/2 object-cover object-center rounded-3xl" src="@/assets/img/header4.jpg">
        </div>
        <div class="flex flex-col gap-3 w-1/2">
            <p class="font-semibold tracking-wide text-slate-400">TUJUAN KAMI</p>
            <h1 class="text-4xl font-bold tracking-tight text-darkTeal pb-5">
                Mempertahankan <span class="text-goldenYellow">Kesehatan Mentalmu</span> anda di level terbaik Bersama <span class="text-skyBlue">Luminds</span>.
            </h1>
            <p class="leading-relaxed text-lg tracking-tight">Di Luminds, kami percaya setiap individu memiliki kekuatan untuk berkembang. Dengan pendekatan inovatif dan personalisasi, kami berkomitmen untuk mendukung pembentukan ketahanan mental, meningkatkan kesejahteraan emosional, dan mencapai kehidupan yang lebih bermakna.</p>
        </div>
    </div>

    <div class="flex flex-col w-full bg-sky-100 px-16 py-32 gap-16 items-center justify-center">
        <div class="flex flex-col gap-3">
            <p class="font-semibold tracking-wide text-blue-400">SOLUSI YANG KAMI TAWARKAN</p>
            <h1 class="text-4xl font-bold tracking-tight text-darkTeal">Berbagai macam layanan dan fitur yang menarik.</h1>
        </div>

        <div class="flex w-full gap-5 items-stretch justify-between">
            <div class="bg-white w-1/4 rounded-3xl shadow-md flex flex-col">
                <img class="w-full rounded-t-3xl" src="@/assets/img/feat1.jpg">
                <div class="flex flex-col gap-3 px-5 py-7 border-b-2 grow">
                    <h1 class="text-xl font-semibold text-darkSlate">Online Consultation</h1>
                    <p class="text-sm">Luminds memberikan akses mudah ke dukungan profesional dalam kesehatan mental. Tim konsultan kami tidak hanya memiliki keahlian akademis, tetapi juga penuh empati. Kami tahu betapa pentingnya memiliki seseorang yang benar-benar peduli dan siap mendengarkan tanpa menghakimi. Dengan kami, kamu akan mendapatkan solusi yang tepat dan empatik untuk kebutuhan mentalmu.</p>
                </div>
                <div class="flex items-center justify-between px-5 py-4">
                    <p class="text-sm font-semibold text-skyBlue">Pelajari lebih lanjut</p>
                    <fa icon="fas fa-chevron-right" class="text-skyBlue" fixed-width />
                </div>
            </div>
            <div class="bg-white w-1/4 rounded-3xl shadow-md flex flex-col">
                <img class="w-full rounded-t-3xl" src="@/assets/img/feat2.jpg">
                <div class="flex flex-col gap-3 px-5 py-7 border-b-2 grow">
                    <h1 class="text-xl font-semibold text-darkSlate">Story Sharing</h1>
                    <p class="text-sm">memberikanmu ruang pribadi untuk berbagi perasaan dan cerita sehari-hari tanpa khawatir dihakimi. Di sini, setiap cerita dihargai dan didengar dengan sepenuh hati. Kami menciptakan lingkungan yang mendukung agar kamu merasa nyaman dan diterima, sehingga kamu bisa berbicara dengan bebas dan terbuka kepada listener yang seumuran denganmu.</p>
                </div>
                <div class="flex items-center justify-between px-5 py-4">
                    <p class="text-sm font-semibold text-skyBlue">Pelajari lebih lanjut</p>
                    <fa icon="fas fa-chevron-right" class="text-skyBlue" fixed-width />
                </div>
            </div>
            <div class="bg-white w-1/4 rounded-3xl shadow-md flex flex-col">
                <img class="w-full rounded-t-3xl" src="@/assets/img/feat3.jpg">
                <div class="flex flex-col gap-3 px-5 py-7 border-b-2 grow">
                    <h1 class="text-xl font-semibold text-darkSlate">Quests</h1>
                    <p class="text-sm">Kamu bisa ikut berpartisipasi dalam misi empati dan solusi. Kirimkan tantangan atau masalah yang kamu hadapi, dan bantu orang lain dengan solusi yang inovatif dalam batas waktu tertentu. Quest kami dirancang untuk meningkatkan kesadaran dan pemahaman, membantu kamu dan orang lain mengatasi permasalahan, serta memahami diri sendiri dan orang lain dengan lebih baik.</p>
                </div>
                <div class="flex items-center justify-between px-5 py-4">
                    <p class="text-sm font-semibold text-skyBlue">Pelajari lebih lanjut</p>
                    <fa icon="fas fa-chevron-right" class="text-skyBlue" fixed-width />
                </div>
            </div>
            <div class="bg-white w-1/4 rounded-3xl shadow-md flex flex-col">
                <img class="w-full rounded-t-3xl" src="@/assets/img/feat4.jpg">
                <div class="flex flex-col gap-3 px-5 py-7 border-b-2 grow">
                    <h1 class="text-xl font-semibold text-darkSlate">Webinar & Workshop</h1>
                    <p class="text-sm">Luminds menawarkan lebih dari sekadar dukungan—kami menghadirkan edukasi dan inspirasi. Bergabunglah dengan sesi-sesi kami untuk mendapatkan wawasan mendalam tentang kesehatan mental dan belajar cara praktis untuk mengelola perasaan serta tantangan sehari-hari yang kamu hadapi.</p>
                </div>
                <div class="flex items-center justify-between px-5 py-4">
                    <p class="text-sm font-semibold text-skyBlue">Pelajari lebih lanjut</p>
                    <fa icon="fas fa-chevron-right" class="text-skyBlue" fixed-width />
                </div>
            </div>
        </div>
    </div>

    <div class="flex w-full bg-white px-16 py-32 gap-16 items-center justify-center">
        <div class="flex w-1/2 flex-col gap-3">
            <p class="font-semibold tracking-wide text-slate-400">MENGAPA KAMI</p>
            <h1 class="text-4xl font-bold tracking-tight text-darkTeal pb-5">Kami menawarkan bantuan <span class="text-skyBlue">profesional</span> dengan harga yang <span class="text-goldenYellow">terjangkau.</span></h1>
            <p class="leading-relaxed text-lg tracking-tight">Kami yakin bahwa kesehatan mental yang baik harus bisa diakses oleh semua orang. Tim kami yang berpengalaman siap memberikan dukungan yang berdampak positif, tanpa membuatmu khawatir tentang biaya. Pengetahuan dan kesejahteraan adalah hak setiap individu, kami percaya bahwa setiap orang berhak mendapatkan dukungan yang memadai untuk mencapai potensi terbaik mereka tanpa batasan finansial.</p>

            <!-- <div class="flex gap-10 pt-10">
                <div class="flex flex-col">
                    <p class="text-skyBlue font-bold text-6xl">100+</p>
                    <p class="text-gray-400">Pasien terlayani</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-skyBlue font-bold text-6xl">100+</p>
                    <p class="text-gray-400">Pasien terlayani</p>
                </div>
                <div class="flex flex-col">
                    <p class="text-skyBlue font-bold text-6xl">100+</p>
                    <p class="text-gray-400">Pasien terlayani</p>
                </div>
            </div> -->
        </div>
        <div class="flex w-1/2 gap-3">
            <img class="w-1/2 object-cover object-center rounded-3xl" src="@/assets/img/why3.jpg">
            <div class="flex w-1/2 flex-col gap-3">
                <img class="w-full h-1/2 object-cover object-center rounded-3xl" src="@/assets/img/why2.jpg">
                <img class="w-full h-1/2 object-cover object-center rounded-3xl" src="@/assets/img/why1.jpg">
            </div>
        </div>
    </div>

    <!-- <div class="flex flex-col w-full bg-sky-100 py-32 gap-16 items-center justify-center">
        <div class="flex flex-col gap-3">
            <p class="font-semibold tracking-wide text-blue-400">TESTIMONI</p>
            <h1 class="text-4xl font-bold tracking-tight text-darkTeal">Apa kata mereka tentang kualitas pelayanan Luminds?</h1>
        </div>

        <div id="default-carousel" class="relative w-full" data-carousel="linear">
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <div class="hidden duration-700 ease-linear px-16" data-carousel-item="active">
                    <div class="flex w-full pt-12 gap-5">
                        <div class="flex w-1/3 flex-col items-center justify-center bg-white rounded-xl shadow-md p-8">
                            <div class="flex flex-col items-center justify-center relative -top-[4.5em] gap-4">
                                <img src="@/assets/img/tes1.jpg" class="w-1/3 border-[6px] border-white rounded-full">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="font-semibold text-2xl">Deborah Wilson</p>
                                    <p class="text-sm text-slate-400">Mahasiswi ITBSS</p>
                                </div>
                            </div>
                            <div class="flex -mt-12 gap-2">
                                <fa icon="fas fa-quote-left" fixed-width class="text-3xl self-start text-skyBlue"></fa>
                                <p class="text-sm text-center self-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto eveniet enim quis veritatis commodi deserunt laboriosam sed doloremque pariatur illo recusandae possimus consectetur cupiditate fuga odio, amet blanditiis ut iste.</p>
                                <fa icon="fas fa-quote-right" fixed-width class="text-3xl self-end text-skyBlue"></fa>
                            </div>
                        </div>
                    
                        <div class="flex w-1/3 flex-col items-center justify-center bg-white rounded-xl shadow-md p-8">
                            <div class="flex flex-col items-center justify-center relative -top-[4.5em] gap-4">
                                <img src="@/assets/img/tes2.jpg" class="w-1/3 border-[6px] border-white rounded-full">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="font-semibold text-2xl">Lisa Elizabeth</p>
                                    <p class="text-sm text-slate-400">Mahasiswi ITBSS</p>
                                </div>
                            </div>
                            <div class="flex -mt-12 gap-2">
                                <fa icon="fas fa-quote-left" fixed-width class="text-3xl self-start text-skyBlue"></fa>
                                <p class="text-sm text-center self-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto eveniet enim quis veritatis commodi deserunt laboriosam sed doloremque pariatur illo recusandae possimus consectetur cupiditate fuga odio, amet blanditiis ut iste.</p>
                                <fa icon="fas fa-quote-right" fixed-width class="text-3xl self-end text-skyBlue"></fa>
                            </div>
                        </div>

                        <div class="flex w-1/3 flex-col items-center justify-center bg-white rounded-xl shadow-md p-8">
                            <div class="flex flex-col items-center justify-center relative -top-[4.5em] gap-4">
                                <img src="@/assets/img/tes3.jpg" class="w-1/3 border-[6px] border-white rounded-full">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="font-semibold text-2xl">Hana Schwartz</p>
                                    <p class="text-sm text-slate-400">Mahasiswi ITBSS</p>
                                </div>
                            </div>
                            <div class="flex -mt-12 gap-2">
                                <fa icon="fas fa-quote-left" fixed-width class="text-3xl self-start text-skyBlue"></fa>
                                <p class="text-sm text-center self-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto eveniet enim quis veritatis commodi deserunt laboriosam sed doloremque pariatur illo recusandae possimus consectetur cupiditate fuga odio, amet blanditiis ut iste.</p>
                                <fa icon="fas fa-quote-right" fixed-width class="text-3xl self-end text-skyBlue"></fa>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden duration-700 ease-linear px-16" data-carousel-item>
                    <div class="flex w-full pt-12 gap-5">
                        <div class="flex w-1/3 flex-col items-center justify-center bg-white rounded-xl shadow-md p-8">
                            <div class="flex flex-col items-center justify-center relative -top-[4.5em] gap-4">
                                <img src="@/assets/img/tes4.jpg" class="w-1/3 border-[6px] border-white rounded-full">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="font-semibold text-2xl">Deborah Wilson</p>
                                    <p class="text-sm text-slate-400">Mahasiswi ITBSS</p>
                                </div>
                            </div>
                            <div class="flex -mt-12 gap-2">
                                <fa icon="fas fa-quote-left" fixed-width class="text-3xl self-start text-skyBlue"></fa>
                                <p class="text-sm text-center self-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto eveniet enim quis veritatis commodi deserunt laboriosam sed doloremque pariatur illo recusandae possimus consectetur cupiditate fuga odio, amet blanditiis ut iste.</p>
                                <fa icon="fas fa-quote-right" fixed-width class="text-3xl self-end text-skyBlue"></fa>
                            </div>
                        </div>
                    
                        <div class="flex w-1/3 flex-col items-center justify-center bg-white rounded-xl shadow-md p-8">
                            <div class="flex flex-col items-center justify-center relative -top-[4.5em] gap-4">
                                <img src="@/assets/img/tes5.jpg" class="w-1/3 border-[6px] border-white rounded-full">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="font-semibold text-2xl">Lisa Elizabeth</p>
                                    <p class="text-sm text-slate-400">Mahasiswi ITBSS</p>
                                </div>
                            </div>
                            <div class="flex -mt-12 gap-2">
                                <fa icon="fas fa-quote-left" fixed-width class="text-3xl self-start text-skyBlue"></fa>
                                <p class="text-sm text-center self-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto eveniet enim quis veritatis commodi deserunt laboriosam sed doloremque pariatur illo recusandae possimus consectetur cupiditate fuga odio, amet blanditiis ut iste.</p>
                                <fa icon="fas fa-quote-right" fixed-width class="text-3xl self-end text-skyBlue"></fa>
                            </div>
                        </div>

                        <div class="flex w-1/3 flex-col items-center justify-center bg-white rounded-xl shadow-md p-8">
                            <div class="flex flex-col items-center justify-center relative -top-[4.5em] gap-4">
                                <img src="@/assets/img/tes6.jpg" class="w-1/3 border-[6px] border-white rounded-full">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="font-semibold text-2xl">Hana Schwartz</p>
                                    <p class="text-sm text-slate-400">Mahasiswi ITBSS</p>
                                </div>
                            </div>
                            <div class="flex -mt-12 gap-2">
                                <fa icon="fas fa-quote-left" fixed-width class="text-3xl self-start text-skyBlue"></fa>
                                <p class="text-sm text-center self-center">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto eveniet enim quis veritatis commodi deserunt laboriosam sed doloremque pariatur illo recusandae possimus consectetur cupiditate fuga odio, amet blanditiis ut iste.</p>
                                <fa icon="fas fa-quote-right" fixed-width class="text-3xl self-end text-skyBlue"></fa>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            </div>

            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </div> -->

    <div class="flex flex-col w-full bg-white py-32 px-16 gap-16 items-center justify-center">
        <div class="flex flex-col gap-3">
            <p class="font-semibold tracking-wide text-blue-400">MITRA KAMI</p>
            <h1 class="text-4xl font-bold tracking-tight text-darkTeal">Bergerak bersama dengan para mitra pendukung kami.</h1>
        </div>

        <div class="flex gap-10 items-center justify-center">
            <img src="@/assets/logo/itbss.png" class="w-1/5">
            <img src="@/assets/logo/istesa.png" class="w-1/5">
        </div>
    </div>    
</template>