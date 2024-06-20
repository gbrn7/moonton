export default function Checkbox({
    className = "",
    checked = false,
    handleChange,
    ...props
}) {
    return (
        <input
            {...props}
            type="checkbox"
            defaultChecked={checked}
            onChange={(e) => handleChange(e)}
            className={
                "rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 " +
                className
            }
        />
    );
}
