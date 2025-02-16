<script setup>
    import { onMounted, ref, useTemplateRef } from 'vue';
    import { RouterLink } from 'vue-router'

    import { initFlowbite } from 'flowbite'

    import StatusCard from '@/components/util/StatusCard.vue'

    const showKonsultasi = ref(true)
    const showWebinar = ref(true)
    const showStory = ref(true)
    const showSearch = ref(false)
    const showNotification = ref(false)

    const isIconVisible = ref(false)

    function toggleNotification(){
        showNotification.value = !showNotification.value
    }
    
    onMounted(() => {
        initFlowbite();
    })
</script>

<template>
    <div class="flex w-full h-full backdrop-blur-[6px]">
        <div class="flex flex-col h-screen justify-between w-[5vw] bg-[#131a1c] text-white sticky top-0 z-50">
            <div class="flex flex-col gap-10 h-full py-8">
                <div class="flex items-center justify-center">
                    <img src="@/assets/svg/logo.svg" class="px-3">
                </div>

                <div class="flex flex-col w-full h-full justify-between" id="menuBox">
                    <div class="flex flex-col h-full gap-3">
                        <!-- <p class="text-gray-500 font-medium">Main Menu</p> -->

                        <div class="flex flex-col">
                            <RouterLink>
                                <div class="flex flex-col gap-2 justify-center items-center hover:bg-skyBlue transition-all ease-in-out duration-500 py-3">
                                    <fa icon="fas fa-home" class="text-2xl" fixed-width></fa>
                                    <p class="text-xs">Home</p>
                                </div>
                            </RouterLink>
                            <RouterLink>
                                <div class="flex flex-col gap-2 justify-center items-center hover:bg-skyBlue transition-all ease-in-out duration-500 py-3">
                                    <fa icon="fas fa-desktop" class="text-2xl" fixed-width></fa>
                                    <p class="text-xs">Webinars</p>
                                </div>
                            </RouterLink>
                            <RouterLink>
                                <div class="flex flex-col gap-2 justify-center items-center hover:bg-skyBlue transition-all ease-in-out duration-500 py-3">
                                    <fa icon="fas fa-comment-dots" class="text-2xl" fixed-width></fa>
                                    <p class="text-xs">Consult</p>
                                </div>
                            </RouterLink>
                            <RouterLink>
                                <div class="flex flex-col gap-2 justify-center items-center hover:bg-skyBlue transition-all ease-in-out duration-500 py-3">
                                    <fa icon="fas fa-scroll" class="text-2xl" fixed-width></fa>
                                    <p class="text-xs">Quests</p>
                                </div>
                            </RouterLink>
                            <RouterLink>
                                <div class="flex flex-col gap-2 justify-center items-center hover:bg-skyBlue transition-all ease-in-out duration-500 py-3">
                                    <fa icon="fas fa-compass" class="text-2xl" fixed-width></fa>
                                    <p class="text-xs">Discover</p>
                                </div>
                            </RouterLink>
                        </div>
                    </div>

                    <div class="flex items-center justify-between rounded-full">
                        <div class="flex items-center justify-center w-full h-full">
                            <button data-tooltip-target="profile" data-tooltip-placement="right" data-tooltip-trigger="click">
                                <div class="flex items-center justify-center w-[2.5vw] h-[2.5vw] rounded-full overflow-hidden">
                                    <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                </div>
                            </button>
                           
                            <div id="profile" role="tooltip" class="absolute invisible transition-all duration-200 ease-in-out">
                                <div class="bg-white text-darkTeal w-72 rounded-xl p-4 shadow-xl ml-5">
                                    <div class="flex items-center justify-between">
                                        <div class="flex gap-3 items-center">
                                            <div class="flex items-center justify-center w-[3vw] h-[3vw] rounded-full overflow-hidden">
                                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                            </div>
                                            <div class="flex flex-col">
                                                <p class="font-medium text-lg">Amanda Davis</p>
                                                <p class="text-sm text-gray-500">Administrator</p>
                                            </div>
                                        </div>
    
                                        <button data-tooltip-target="logout" data-tooltip-placement="top" data-tooltip-trigger="hover">
                                            <fa icon="fas fa-right-from-bracket" class="text-2xl text-red-500" fixed-width></fa>
                                        </button>
                                                
                                        <div id="logout" role="tooltip" class="invisible absolute px-3 py-1 rounded-lg text-white bg-darkTeal transition-all duration-200 ease-in-out">
                                            Logout
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <fa icon="fas fa-gear" class="text-xl" /> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="w-[75vw] h-full">
            <div class="flex flex-col w-full h-full">
                <div class="flex flex-col w-full h-full overflow-y-scroll no-scrollbar pb-0 z-0">
                    <div class="w-full sticky top-0 z-40">
                        <div class="w-full fixed backdrop-blur-[4px] top-0 z-[-1] mask-image-gradient-to-b from-black to-transparent h-24"></div>

                        <div class="p-5 pb-0 z-50">
                            <div class="flex flex-row items-center justify-between w-full rounded-xl shadow-sm-light bg-white">
                                <div class="flex items-center w-1/3 pl-5">
                                    <Transition name="expand">
                                        <div class="flex items-center rounded-lg w-full transition-all duration-500" :class="[showSearch ? 'bg-gray-200 p-2' : 'bg-white']">
                                            <fa icon="fas fa-search" fixed-width class="text-darkTeal transition-all duration-300 ease-in-out" :class="[showSearch ? 'text-md pl-1 pr-2' : 'text-lg']" @click="() => showSearch = !showSearch"></fa>

                                            <input type="text" class="border-0 outline-none focus:ring-0 bg-transparent p-0 transition-all duration-100" :class="[showSearch ? 'w-full' : 'w-0']" placeholder="Cari..." />
                                        </div>
                                    </Transition>

                                    <!-- <RouterLink to="/" class="pb-0 border-0" :active-class="'pb-2 border-b-[1px] border-b-gray'">Berita</RouterLink> -->
                                </div>

                                <div class="flex justify-center items-center w-1/3 p-5">
                                    <p class="text-gray-500 text-sm">Home</p>
                                </div>

                                <div class="flex items-center gap-2 w-1/3 justify-end p-5">
                                    <button @click="toggleNotification()">
                                        <fa icon="fas fa-bell" fixed-width class="text-lg text-darkTeal"></fa>
                                    </button>
                                
                                    <Transition name="slideDown">
                                        <div v-if="showNotification" class="absolute transition-all duration-200 ease-in-out z-50 w-1/3 top-[4.5em]">
                                            <div class="w-full h-full text-darkTeal bg-white rounded-xl shadow-xl ml-5 overflow-hidden">
                                                <div class="flex flex-col items-center justify-center [&>:not(:first-child)]:border-t-[1px] *:border-gray-200 *:w-full *:py-3 *:px-3">
                                                    <div class="bg-darkTeal">
                                                        <p class="font-semibold text-center text-white">Notifikasi</p>
                                                    </div>

                                                    <div class="flex gap-3 items-center hover:bg-gray-200 transition-all duration-200">
                                                        <div class="w-1/12">
                                                            <div class="flex items-center justify-center w-[2.5vw] h-[2.5vw] rounded-full overflow-hidden">
                                                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                                            </div>
                                                        </div>

                                                        <div class="w-11/12 pl-2">
                                                            <div class="flex items-center justify-between w-full">
                                                                <p class="font-semibold">Nama pengguna #1</p>
                                                                <p class="font-semibold text-xs text-gray-500">03.09 PM</p>
                                                            </div>
                                                            <p class="text-xs text-gray-400">Memposting sebuah quest baru! Klik disini untuk melihat quest tersebut.</p>
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-3 items-center hover:bg-gray-200 transition-all duration-200">
                                                        <div class="w-1/12">
                                                            <div class="flex items-center justify-center w-[2.5vw] h-[2.5vw] rounded-full overflow-hidden">
                                                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                                            </div>
                                                        </div>

                                                        <div class="w-11/12 pl-2">
                                                            <div class="flex items-center justify-between w-full">
                                                                <p class="font-semibold">Nama pengguna #1</p>
                                                                <p class="font-semibold text-xs text-gray-500">03.09 PM</p>
                                                            </div>
                                                            <p class="text-xs text-gray-400">Memposting sebuah quest baru! Klik disini untuk melihat quest tersebut.</p>
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-3 items-center hover:bg-gray-200 transition-all duration-200">
                                                        <div class="w-1/12">
                                                            <div class="flex items-center justify-center w-[2.5vw] h-[2.5vw] rounded-full overflow-hidden">
                                                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                                            </div>
                                                        </div>

                                                        <div class="w-11/12 pl-2">
                                                            <div class="flex items-center justify-between w-full">
                                                                <p class="font-semibold">Nama pengguna #1</p>
                                                                <p class="font-semibold text-xs text-gray-500">03.09 PM</p>
                                                            </div>
                                                            <p class="text-xs text-gray-400">Memposting sebuah quest baru! Klik disini untuk melihat quest tersebut.</p>
                                                        </div>
                                                    </div>

                                                    <div class="flex gap-3 items-center hover:bg-gray-200 transition-all duration-200">
                                                        <div class="w-1/12">
                                                            <div class="flex items-center justify-center w-[2.5vw] h-[2.5vw] rounded-full overflow-hidden">
                                                                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                                                            </div>
                                                        </div>

                                                        <div class="w-11/12 pl-2">
                                                            <div class="flex items-center justify-between w-full">
                                                                <p class="font-semibold">Nama pengguna #1</p>
                                                                <p class="font-semibold text-xs text-gray-500">03.09 PM</p>
                                                            </div>
                                                            <p class="text-xs text-gray-400">Memposting sebuah quest baru! Klik disini untuk melihat quest tersebut.</p>
                                                        </div>
                                                    </div>

                                                    <button @mouseover="() => isIconVisible = true" @mouseout="() => isIconVisible = false" class="w-full bg-darkTeal text-white p-3 text-sm flex items-center justify-center">
                                                        <fa icon="fas fa-chevron-right" fixed-width class="pr-1 text-sm transition-all duration-200" :class="[isIconVisible ? 'text-sm' : 'text-[0px]']"></fa>

                                                        Lihat selengkapnya
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </Transition>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pb-0">
                        <RouterView></RouterView>
                    </div>
                </div>
            </div>          
        </div>

        <div class="h-screen w-[20vw] py-5 pr-5 sticky top-0 right-0 z-30">
            <div class="flex flex-col gap-5 backdrop-blur-[8px] bg-[#FFFD] w-full rounded-xl h-full shadow-sm-light">
                <div class="p-5 pb-2">
                    <div class="flex gap-3 items-center">
                        <img class="w-[4vw] h-[4vw] object-cover rounded-full" src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" />

                        <div class="flex flex-col gap-[0.2em]">
                            <p class="font-medium text-xs tracking-wide text-slate-400">Selamat datang di Luminds,</p>
                            <h1 class="text-xl font-bold tracking-tight text-darkTeal">Amanda Davis!</h1>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col gap-1">
                    <button @click="() => showKonsultasi = !showKonsultasi" class="flex w-full items-center justify-between text-slate-400 px-5" type="button">
                        <p class="text-xs font-semibold tracking-wide">KONSULTASI ONLINE - 2</p>
                        
                        <fa icon="fas fa-chevron-down" class="text-xs transition-all duration-300" :class="{'rotate-180': showKonsultasi}"></fa>
                    </button>

                    <Transition name="slideUp" mode="out-in">
                        <div v-if="showKonsultasi" id="konsultasi" class="flex flex-col pt-1 px-3">
                            <StatusCard />
                            <StatusCard />
                        </div>
                    </Transition>
                </div>

                <div class="flex flex-col gap-1">
                    <button @click="() => showWebinar = !showWebinar" class="flex w-full items-center justify-between text-slate-400 px-5" type="button">
                        <p class="text-xs font-semibold tracking-wide">WEBINAR - 2</p>
                        
                        <fa icon="fas fa-chevron-down" class="text-xs transition-all duration-300" :class="{'rotate-180': showWebinar}"></fa>
                    </button>

                    <Transition name="slideUp" mode="out-in">
                        <div v-if="showWebinar" id="webinar" class="flex flex-col pt-1 px-3">
                            <StatusCard />
                            <StatusCard />
                        </div>
                    </Transition>
                </div>

                <div class="flex flex-col gap-1">
                    <button @click="() => showStory = !showStory" class="flex w-full items-center justify-between text-slate-400 px-5" type="button">
                        <p class="text-xs font-semibold tracking-wide">STORY SHARING - 2</p>
                        
                        <fa icon="fas fa-chevron-down" class="text-xs transition-all duration-300" :class="{'rotate-180': showStory}"></fa>
                    </button>

                    <Transition name="slideUp" mode="out-in">
                        <div v-if="showStory" id="story" class="flex flex-col pt-1 px-3">
                            <StatusCard />
                            <StatusCard />
                        </div>
                    </Transition>
                </div>
            </div>
        </div>
    </div>
</template>