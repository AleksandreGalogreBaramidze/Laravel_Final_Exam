<template>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        class="p-6 bg-white border-b border-gray-200 flex w-full"
                    >
                        <div
                            class="shadow rounded w-2/3 p-5 flex flex-col justify-start items-center"
                        >
                            <div
                                id="map"
                                class="w-full h-96 flex items-center justify-center"
                            ></div>
                        </div>
                        <div class="shadow rounded w-1/3 p-5">
                            <div class="shadow border-2 border-black p-3">
                                <div class="flex items-center justify-around">
                                    <img src="/img/world.png" />
                                    <h1 class="text-2xl text-green-500">
                                        World
                                    </h1>
                                </div>
                                <div
                                    class="shadow rounded p-6 flex text-center gap-1"
                                >
                                    <div
                                        class="w-1/3 p-1 border-2 border-black shadow:xl"
                                    >
                                        <h2 class="text-red-500">
                                            {{ this.WorldData.todayCases }}
                                        </h2>

                                        todayCases
                                    </div>
                                    <div
                                        class="w-1/3 p-1 border-2 border-black shadow:xl"
                                    >
                                        <h2 class="text-red-500">
                                            {{ this.WorldData.todayDeaths }}
                                        </h2>

                                        todayDeaths
                                    </div>
                                    <div
                                        class="w-1/3 p-1 border-2 border-black shadow:xl"
                                    >
                                        <h2 class="text-green-500">
                                            {{ this.WorldData.todayRecovered }}
                                        </h2>

                                        todayRecovered
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 shadow p-5 flex flex-col gap-2">
                                <div
                                    class="flex justify-around items-center p-2"
                                >
                                    <Select2
                                        class="w-96"
                                        v-model="SelectedCountry"
                                        :options="SelectedCountries"
                                        :settings="{
                                            width: '100%',
                                            ajax: {
                                                url: '/api/countries/list',
                                                dataType: 'json',
                                            },
                                        }"
                                        @select="ChooseCountry($event)"
                                    />
                                    <a
                                        @click="AddCountry"
                                        class="ml-1 px-3 pt-1 text-sm bg-green-400 hover:bg-green-300 font-semibold shadow hover:shadow-xl rounded text-white"
                                        href="javascript:void(0)"
                                        >Add</a
                                    >
                                </div>
                                <div
                                    v-for="sc in SelectedCountries"
                                    :key="sc.id"
                                >
                                    <div
                                        class="shadow border-2 border-black p-3"
                                    >
                                        <div
                                            class="flex items-center justify-between px-6"
                                        >
                                            <div
                                                class="flex justify-between items-center p-1 gap-2"
                                            >
                                                <img
                                                    class="w-24 border-2 border-black"
                                                    :src="
                                                        this
                                                            .SelectedCountriesInfo[
                                                            sc.country_code
                                                        ].countryInfo.flag
                                                    "
                                                />

                                                <h1
                                                    class="text-2xl text-green-500"
                                                >
                                                    {{
                                                        this
                                                            .SelectedCountriesInfo[
                                                            sc.country_code
                                                        ]["country"]
                                                    }}
                                                </h1>
                                            </div>
                                            <a
                                                @click="
                                                    DeleteCountry(sc.id)
                                                "
                                                href="javascript:void(0)"
                                                class="ml-2 text-md font-semibold px-2"
                                                ><i
                                                    class="fas fa-trash text-red-500 hover:text-red-400"
                                                ></i
                                            ></a>
                                        </div>
                                        <div
                                            class="shadow rounded p-6 flex text-center gap-1"
                                        >
                                            <div
                                                class="w-1/3 p-3 border-2 border-black shadow:xl flex flex-col items-center justify-around"
                                            >
                                                <h2 class="text-red-500">
                                                    {{
                                                        this
                                                            .SelectedCountriesInfo[
                                                            sc.country_code
                                                        ]["todayCases"]
                                                    }}
                                                </h2>

                                                <p class="text-sm">
                                                    todayCases
                                                </p>
                                            </div>
                                            <div
                                                class="w-1/3 p-3 border-2 border-black shadow:xl flex flex-col items-center justify-around"
                                            >
                                                <h2 class="text-red-500">
                                                    {{
                                                        this
                                                            .SelectedCountriesInfo[
                                                            sc.country_code
                                                        ]["todayDeaths"]
                                                    }}
                                                </h2>

                                                <p class="text-sm">
                                                    todayDeaths
                                                </p>
                                            </div>
                                            <div
                                                class="w-1/3 p-3 border-2 border-black shadow:xl flex flex-col items-center justify-around"
                                            >
                                                <h2 class="text-green-500">
                                                    {{
                                                        this
                                                            .SelectedCountriesInfo[
                                                            sc.country_code
                                                        ]["todayRecovered"]
                                                    }}
                                                </h2>

                                                <p class="text-sm">
                                                    todayRecovered
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Select2 from "vue3-select2-component";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Select2,
    },
    data() {
        return {
            WorldData: {},
            SelectedCountry: "",
            SelectedCountries: [],
            SelectedCountriesInfo: {},
            mapData: {},
            map: {},
        };
    },
    methods: {
        ChooseCountry({ id, text }) {
        },
        GetInfectedInWorld() {
            axios
                .get("https://disease.sh/v3/covid-19/all")
                .then((res) => (this.WorldData = res.data));
        },
        GetCountries() {
            axios.get("api/countries/selected").then(
                (res) => (
                    (this.SelectedCountries = res.data),
                    this.SelectedCountries.forEach((country) => {
                        this.GetInfectedCountries(country.country_code);
                        this.mapData[country.country_code] = {
                            fillKey: "selected",
                        };
                    })
                )
            );
        },
        DeleteCountry(id) {
            axios
                .post("/api/countries/delete-selected-country", {
                    countryId: id,
                })
                .then((res) => {
                    this.GetCountries();
                    this.map.updateChoropleth({
                        [res.data.country_code]: { fillKey: "defaultFill" },
                    });
                })
                .catch((err) => console.log(err));
        },
        AddCountry() {
            if (this.SelectedCountry !== "") {
                axios
                    .post("api/countries/add-selected", {
                        countryId: this.SelectedCountry,
                    })
                    .then((res) => {
                        this.GetCountries();
                        this.map.updateChoropleth({
                            [res.data.country_code]: { fillKey: "selected" },
                        });
                    });
            }
        },
        
        MapInitialization() {
            this.map = new Datamap({
                element: document.getElementById("map"),
                projection: "mercator",
                fills: {
                    defaultFill: "#ABDDA4",
                    selected: "#fa0fa0",
                },
                data: {
                    ...this.mapData,
                },
            });
        },
        GetInfectedCountries(country_code) {
            let url = `https://disease.sh/v3/covid-19/countries/${country_code}`;
            axios
                .get(url)
                .then(
                    (res) =>
                        (this.SelectedCountriesInfo[country_code] = res.data)
                );
        },
    
    },
    created() {
        this.GetInfectedInWorld();
        this.GetChoosedCountries();
        setTimeout(() => {
            this.MapInitialization();
        }, 1500);
    },
};
</script>
