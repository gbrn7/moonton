import Auhtenticated from "@/Layouts/Authenticated/Index";
import Flickity from "react-flickity-component";
import { Head } from "@inertiajs/react";
import FeaturedMovie from "@/Components/FeaturedMovie";
import MovieCard from "@/Components/MovieCard";

export default function Dashboard() {
    const flicityOptions = {
        cellAlign: "left",
        contain: true,
        groupCells: 1,
        wrapAround: false,
        pageDots: false,
        prevNextButtons: false,
        draggable: ">1",
    };
    return (
        <Auhtenticated>
            <Head>
                <title>Dashboard</title>
                <link
                    rel="stylesheet"
                    href="https://unpkg.com/flickity@2/dist/flickity.min.css"
                />
            </Head>
            <div>
                <div className="font-semibold text-[22px] text-black mb-4">
                    Featured Movies
                </div>
                <Flickity className="gap-[30px]" options={flicityOptions}>
                    {[1, 2, 3, 2, 3].map((item, index) => (
                        <FeaturedMovie
                            key={index}
                            slug={"the-batman-in-love"}
                            name={`The Batman in Love ${index}`}
                            category={"Comedy"}
                            thumbnail="/images/featured-1.png"
                            rating={index + 1}
                        />
                    ))}
                </Flickity>
            </div>
            <div className="mt-[50px]">
                <div className="font-semibold text-[22px] text-black mb-4">
                    Browse
                </div>
                <Flickity className="gap-[30px]" options={flicityOptions}>
                    {[1, 2, 3, 4, 5, 6].map((i) => (
                        <MovieCard
                            key={i}
                            slug={"the-batman-in-love"}
                            name={`The Batman in Love ${i}`}
                            category={"Comedy"}
                            thumbnail="/images/featured-1.png"
                        />
                    ))}
                </Flickity>
            </div>
        </Auhtenticated>
    );
}
