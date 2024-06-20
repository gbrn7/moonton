export default function Checkbox({ className = "", handleChange, ...props }) {
    return (
        <input
            {...props}
            type="checkbox"
            onChange={(e) => handleChange(e)}
            className={
                "rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 " +
                className
            }
        />
    );
}
