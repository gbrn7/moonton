import ValidationErrors from "@/Components/ValidationErrors";
import Label from "@/Components/Label";
import Input from "@/Components/Input";
import Checkbox from "@/Components/Checkbox";
import Button from "@/Components/Button";
import Authenticated from "@/Layouts/Authenticated/Index";
import { Head, useForm } from "@inertiajs/react";
import InputError from "@/Components/InputError";

export default function Create({ auth }) {
    const { setData, post, processing, errors } = useForm({
        name: "",
        category: "",
        video_url: "",
        thumbnail: "",
        rating: "",
        is_featured: false,
    });

    const onHandleChange = (event) => {
        setData(
            event.target.name,
            event.target.type === "file"
                ? event.target.files[0]
                : event.target.value
        );
    };

    const submit = (e) => {
        e.preventDefault();

        post(route("administrator.dashboard.movie.store"));
    };
    return (
        <Authenticated auth={auth}>
            <Head title="Admin - Create Movie" />
            <h1 className="text-xl">Insert a new Movie</h1>
            <hr className="mb-4" />
            <ValidationErrors errors={errors} />
            <form onSubmit={submit}>
                <Label forInput="name" value="Name" />
                <Input
                    type="text"
                    name="name"
                    variant="primary-outline"
                    handleChange={onHandleChange}
                    placeholder="Enter the neme of the movie"
                    isError={errors.name}
                />
                <InputError message={errors.name} className="mt-2" />
                <Label forInput="category" value="Category" classname="mt-4" />
                <Input
                    type="text"
                    name="category"
                    variant="primary-outline"
                    handleChange={onHandleChange}
                    placeholder="Enter the category of the movie"
                    isError={errors.category}
                />
                <InputError message={errors.category} className="mt-2" />
                <Label
                    forInput="video_url"
                    value="Video URL"
                    classname="mt-4"
                />
                <Input
                    type="text"
                    name="video_url"
                    variant="primary-outline"
                    handleChange={onHandleChange}
                    placeholder="Enter the video_url of the movie"
                    isError={errors.video_url}
                />
                <InputError message={errors.video_url} className="mt-2" />
                <Label
                    forInput="thumbnail"
                    value="Thumbnail"
                    classname="mt-4"
                />
                <Input
                    type="file"
                    name="thumbnail"
                    variant="primary-outline"
                    handleChange={onHandleChange}
                    placeholder="Insert the thumbnail of the movie"
                    isError={errors.thumbnail}
                />
                <InputError message={errors.thumbnail} className="mt-2" />
                <Label forInput="rating" value="Rating" classname="mt-4" />
                <Input
                    type="text"
                    name="rating"
                    variant="primary-outline"
                    handleChange={onHandleChange}
                    placeholder="Enter the rating of the movie"
                    isErrorisError={errors.rating}
                />
                <div className="flex flex-row mt-4 items-center">
                    <Label
                        forInput="is_featured"
                        value="Is Featured"
                        classname="mr-3 mt-1"
                    />
                    <Checkbox
                        name="is_featured"
                        handleChange={(e) =>
                            setData("is_featured", e.target.checked)
                        }
                    />
                    <InputError message={errors.is_featured} className="mt-2" />
                </div>

                <Button type="submit" className="mt-4" processing={processing}>
                    Save
                </Button>
            </form>
        </Authenticated>
    );
}
