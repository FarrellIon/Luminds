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
    <div class="flex flex-row items-center justify-between w-full px-16 py-6 sticky top-0 z-50"  :class="{'bg-white shadow-md rounded-b-3xl' : y > 120}">
        <div class="w-1/3">
            <img src="@/assets/logo/full-white-logo.svg" class="w-1/3">
        </div>
        
        <div class="flex items-center justify-center *:px-3">
            <RouterLink to="/">Beranda</RouterLink>
            <RouterLink to="/team">Tim</RouterLink>
            <RouterLink to="/">Fitur</RouterLink>
            <RouterLink to="/">Workshop</RouterLink>
            <RouterLink to="/">Quest</RouterLink>
        </div>

        <div class="flex w-1/3 justify-end">
            Selamat datang, Admin!
        </div>
    </div>
</template>