export default function Label({ forInput, value, classname, children }) {
    return (
        <label
            htmlFor={forInput}
            className={`text-base block mb-2 ${classname ? classname : ""}`}
        >
            {value ? value : children}
        </label>
    );
}
