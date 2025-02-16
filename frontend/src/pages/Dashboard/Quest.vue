<script setup>
</script>

<template>
    <div class="flex flex-col w-full gap-10">
        <div class="flex flex-col w-full py-4 gap-6">
            <div class="flex flex-col gap-2">
                <p class="font-semibold tracking-wide text-slate-400">KONSULTASI</p>
                <h1 class="text-3xl font-bold tracking-tight text-darkTeal">Cek jadwal konsultasi anda disini.</h1>
            </div>

            <div class="flex w-full py-5 overflow-x-scroll gap-4 [&>div]:flex-shrink-0 scrollbar">
                <div class="w-[32vw] bg-white rounded-xl shadow-xl shadow-gray-100">
                    <img src="https://wallpapers.com/images/hd/an-expert-consultant-uvunln2kxmvuitgv.jpg" class="w-full h-[13vh] rounded-t-xl object-cover">
                    
                    <div class="flex flex-col p-5 text-sm relative">
                        <div class="flex absolute -top-14 w-full left-0 justify-between px-5">
                            <img src="https://images.pexels.com/photos/91227/pexels-photo-91227.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=11" class="w-28 h-28 object-cover rounded-full">

                            <div class="self-end">
                                <span class="bg-amber-200 px-3 py-2 rounded-lg text-yellow-600 font-medium">
                                    <fa icon="fas fa-star" />
                                    4.85 (28 Reviews)
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 pt-12">
                            <div>
                                <p class="w-full text-2xl font-semibold text-darkTeal">Nama Konsultan #1</p>
                                <p class="text-gray-400">
                                    <fa icon="fas fa-calendar-days" class="pr-0.5"></fa>
                                    8 September 2024, 11.00 WIB
                                </p>
                            </div>
                            <p class="w-full text-gray-400 text-ellipsis">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, omnis placeat nihil similique esse illum, soluta tenetur repellendus possimus, officiis unde. Fugit natus alias quibusdam incidunt ullam, fuga ratione. Nostrum.</p>
                        </div>

                        <div class="flex gap-2 pt-5">
                            <span class="bg-blue-200 px-3 py-2 rounded-lg text-blue-800 font-medium">Consultation</span>
                            <span class="bg-indigo-200 px-3 py-2 rounded-lg text-indigo-800 font-medium">Anxiety</span>
                            <span class="bg-indigo-200 px-3 py-2 rounded-lg text-indigo-800 font-medium">Depression</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-full py-4 gap-6">
            <div class="flex flex-col gap-2">
                <p class="font-semibold tracking-wide text-slate-400">WEBINAR</p>
                <h1 class="text-3xl font-bold tracking-tight text-darkTeal">Cek jadwal webinar anda disini.</h1>
            </div>

            <div class="flex w-full py-5 overflow-x-scroll gap-4 [&>div]:flex-shrink-0 scrollbar">
                <div class="w-[32vw] bg-white rounded-xl shadow-xl shadow-gray-100">
                    <img src="https://wallpapers.com/images/hd/an-expert-consultant-uvunln2kxmvuitgv.jpg" class="w-full h-[13vh] rounded-t-xl object-cover">
                    
                    <div class="flex flex-col p-5 text-sm relative">
                        <div class="flex absolute -top-14 w-full left-0 justify-between px-5">
                            <img src="https://images.pexels.com/photos/91227/pexels-photo-91227.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=11" class="w-28 h-28 object-cover rounded-full">

                            <div class="self-end">
                                <span class="bg-amber-200 px-3 py-2 rounded-lg text-yellow-600 font-medium">
                                    <fa icon="fas fa-users" class="pr-0.5" />
                                    120 Partisipan
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 pt-12">
                            <div class="w-full flex flex-col">
                                <p class="w-full text-2xl font-semibold text-darkTeal">Nama Webinar #1</p>
                                <div class="flex items-center justify-between w-full text-gray-400">
                                    <p>
                                        Oleh Nama Konsultan #1 
                                    </p>
                                    <p>
                                        <fa icon="fas fa-calendar-days" class="pr-0.5"></fa>
                                        8 September 2024, 11.00 WIB
                                    </p>
                                </div>
                            </div>
                            <p class="w-full text-gray-400 text-ellipsis">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, omnis placeat nihil similique esse illum, soluta tenetur repellendus possimus, officiis unde. Fugit natus alias quibusdam incidunt ullam, fuga ratione. Nostrum.</p>
                        </div>
                        <div class="flex gap-2 pt-5">
                            <span class="bg-blue-200 px-3 py-2 rounded-lg text-blue-800 font-medium">Consultation</span>
                            <span class="bg-indigo-200 px-3 py-2 rounded-lg text-indigo-800 font-medium">Anxiety</span>
                            <span class="bg-indigo-200 px-3 py-2 rounded-lg text-indigo-800 font-medium">Depression</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>