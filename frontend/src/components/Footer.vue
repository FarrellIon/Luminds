<template>
    <div class="flex flex-col bg-darkTeal p-16 gap-12">
        <div class="flex items-center justify-between w-full">
            <div class="flex w-3/12">
                <div class="flex flex-col gap-1">
                    <img src="@/assets/logo/full-black-logo.svg" class="w-2/3">

                    <p class="text-white text-lg">Tumbuhkan Kesehatan Mental bersama Luminds.</p>
                </div>
            </div>

            <div class="flex flex-col gap-7 w-3/12">   
                <p class="font-semibold text-white text-xl">Mengenai kami</p>

                <div class="flex w-full gap-12 text-white">
                    <div class="flex flex-col gap-2">
                        <p>Tentang kami</p>
                        <p>Annual Checkup</p>
                        <p>Blog</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p>Syarat & Ketentuan</p>
                        <p>Karir</p>
                        <p>FAQ</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-7 w-3/12">
                <p class="font-semibold text-white text-xl pt-2">Hubungi kami</p>

                <div class="flex flex-col w-full gap-2 text-white">
                    <div class="flex gap-3 items-center">
                        <fa icon="fas fa-home" fixed-width />
                        <p>Jalan Purnama 2</p>
                    </div>
                    <div class="flex gap-3 items-center">
                        <fa icon="fas fa-phone" fixed-width />
                        <p>+62 812 3456 7890</p>
                    </div>
                    <div class="flex gap-3 items-center">
                        <fa icon="fas fa-envelope" fixed-width />
                        <p>luminds@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex border-t-[1px] border-white pt-10 text-white items-center justify-between">
            <div>
                <fa icon="far fa-copyright" />
                2024 Luminds. All rights reserved.
            </div>
            <div class="flex gap-3 items-center">
                <a>
                    <fa icon="fab fa-whatsapp" class="text-3xl"></fa>
                </a>
                <a>
                    <fa icon="fab fa-instagram" class="text-3xl"></fa>
                </a>
                <a>
                    <fa icon="fab fa-tiktok" class="text-3xl"></fa>
                </a>
                <a>
                    <fa icon="fab fa-facebook" class="text-3xl"></fa>
                </a>
                <a>
                    <fa icon="fab fa-linkedin" class="text-3xl"></fa>
                </a>
            </div>
        </div>
    </div>
</template>