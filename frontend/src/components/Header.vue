<script setup>
    import { RouterLink } from 'vue-router'
    import { ref, onMounted } from 'vue'

    const y = ref(0)
    const dropdown = ref(false)

    function updateScroll(){
        y.value = window.scrollY
    }

    onMounted(() => {   
        window.addEventListener('scroll', updateScroll)
    })
</script>
<template>
    <div class="flex flex-row items-center justify-between w-full px-16 py-6 sticky top-0 z-50"  :class="{'bg-white shadow-md rounded-b-3xl' : y > 50}">
        <div class="w-1/3">
            <img src="@/assets/logo/full-white-logo.svg" class="w-1/3">
        </div>
        
        <div class="flex items-center justify-center *:px-3">
            <RouterLink to="/home" class="border-0" :active-class="'border-b-2 border-b-skyBlue'">Beranda</RouterLink>
            <RouterLink to="/team" class="border-0" :active-class="'border-b-2 border-b-skyBlue'">Tentang Kami</RouterLink>
            <!-- <RouterLink to="/" class="pb-0 border-0" :active-class="'pb-2 border-b-[1px] border-b-gray'">Berita</RouterLink> -->
        </div>

        <div class="flex w-1/3 justify-end">
            <!-- Selamat datang, Admin! -->
        </div>
    </div>
</template>