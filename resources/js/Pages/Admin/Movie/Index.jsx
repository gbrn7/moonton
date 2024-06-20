import Authenticated from "@/Layouts/Authenticated/Index";
import Button from "@/Components/Button";
import FlashMessage from "@/Components/FlashMessage";
import { Head, Link, useForm } from "@inertiajs/react";

export default function Index({ auth, flashMessage, movies }) {
    const { delete: destroy, put } = useForm();

    return (
        <Authenticated auth={auth}>
            <Head>
                <title>Admin - List Movie</title>
            </Head>
            <Link href={route("administrator.dashboard.movie.create")}>
                <Button type="button" className="max-w-40 mb-8">
                    Insert New Movie
                </Button>
            </Link>
            {flashMessage?.message && (
                <FlashMessage message={flashMessage.message} />
            )}
            <table className="table-fixed w-full text-center">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Rating</th>
                        <th colSpan={2}>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {movies.map((movie) => (
                        <tr key={movie.id}>
                            <td>
                                <img
                                    src={`/storage/${movie.thumbnail}`}
                                    className="w-32 rounded-md"
                                    alt=""
                                />
                            </td>
                            <td>{movie.name}</td>
                            <td>{movie.category}</td>
                            <td>{movie.rating.toFixed(1)}</td>
                            <td>
                                <Link
                                    href={route(
                                        "administrator.dashboard.movie.edit",
                                        movie.id
                                    )}
                                >
                                    <Button type="button" variant="warning">
                                        Edit
                                    </Button>
                                </Link>
                            </td>
                            <td>
                                <div
                                    onClick={() => {
                                        movie.deleted_at
                                            ? put(
                                                  route(
                                                      "administrator.dashboard.movie.restore",
                                                      movie.id
                                                  )
                                              )
                                            : destroy(
                                                  route(
                                                      "administrator.dashboard.movie.destroy",
                                                      movie.id
                                                  )
                                              );
                                    }}
                                >
                                    <Button type="button" variant="danger">
                                        {movie.deleted_at
                                            ? "Restore"
                                            : "Delete"}
                                    </Button>
                                </div>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </Authenticated>
    );
}
