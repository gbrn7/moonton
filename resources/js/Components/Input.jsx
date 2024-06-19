import React, { useEffect, useRef } from "react";
import PropTypes from "prop-types";

Input.propTypes = {
    type: PropTypes.oneOf(["text", "email", "password", "number", "file"]),
    name: PropTypes.string,
    value: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
    defaultValue: PropTypes.string,
    variant: PropTypes.oneOf(["primary", "error"], "primary-outline"),
    required: PropTypes.bool,
    isFocused: PropTypes.bool,
    handleChange: PropTypes.func,
    placeholder: PropTypes.string,
    isError: PropTypes.bool,
};

export default function Input({
    type = "text",
    defaultValue,
    variant = "primary",
    placeholder,
    className,
    isFocused,
    iserror,
    required,
    autoComplete,
    value,
    handleChange,
    name,
}) {
    const input = useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <div className="flex flex-col items-center">
            <input
                type={type}
                name={name}
                value={value}
                defaultValue={defaultValue}
                className={`rounded-2xl bg-form-bg py-[13px] px-7 w-full input-${variant} ${className}`}
                ref={input}
                autoComplete={autoComplete}
                onChange={(e) => handleChange(e)}
                placeholder={placeholder}
                required={required}
                iserror={iserror}
            />
        </div>
    );
}
