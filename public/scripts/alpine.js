document.addEventListener("livewire:load", function () {
    Alpine.data("dataOrdinal", () => ({
        ordinal: [
            {
                index: 1,
                l: 0,
                g: 700000000,
                opacity: 0.4,
                color: "#fad4d4",
            },
            {
                index: 2,
                l: 700000000,
                g: 1000000000,
                opacity: 0.5,
                color: "#f78686",
            },
            {
                index: 3,
                l: 1000000000,
                g: 1700000000,
                opacity: 0.6,
                color: "#fa5c5c",
            },
            {
                index: 4,
                l: 1700000000,
                g: 2400000000,
                opacity: 0.7,
                color: "#f21f1f",
            },
            {
                index: 5,
                l: 2400000000,
                g: 3500000000,
                opacity: 0.8,
                color: "#c90202",
            },
            {
                index: 6,
                l: 3500000000,
                g: 10000000000,
                opacity: 0.9,
                color: "#380101",
            },
        ],
        MapDetails: false,
        // showProperty: false,
        long: 0,
        lat: 0,
        harga: 0,

        modal(lat, long, harga) {
            this.long = long;
            this.lat = lat;
            this.harga = harga;
            this.MapDetails = true;
        },
    }));

    Alpine.data("search", () => ({
        nameLocation: [
            {
                display_name: "Bandung, Batang, Jawa Tengah, Indonesia",
            },
            {
                display_name: "Bandung, Sragen, Jawa Tengah, 57211, Indonesia",
            },
            {
                display_name:
                    "Bandung, Boyolali, Jawa Tengah, 57382, Indonesia",
            },
            {
                display_name: "Bandung, Jepara, Jawa Tengah, Indonesia",
            },
            {
                display_name: "Bandung, Kebumen, Jawa Tengah, 54311, Indonesia",
            },
            {
                display_name:
                    "Bandung, Playen, Kabupaten Gunung Kidul, Daerah Istimewa Yogyakarta, Indonesia",
            },
            {
                display_name: "Bandung, Mojokerto, Jawa Timur, Indonesia",
            },
            {
                display_name:
                    "Bandung, Jalan Stasiun Timur, Kebon Jeruk, Andir, Bandung, Jawa Barat, 40181, Indonesia",
            },
            {
                display_name:
                    "Bandung, Jalan Stasiun Barat, Kebon Jeruk, Andir, Bandung, Jawa Barat, 40181, Indonesia",
            },
            {
                display_name: "Bandung, Jawa Barat, Indonesia",
            },
        ],

        resultLocation: [],

        findLocation(event) {
            const keyword = event.target.value;
            let pattern = new RegExp(keyword, "i");
            let resultLocationFilter = this.nameLocation.filter((e) =>
                e.display_name.match(pattern)
            );
            // console.log(keyword);
            this.resultLocation = resultLocationFilter;
            // console.log(this.resultLokasi);
        },
    }));
});
