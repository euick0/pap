'use client';
import React from 'react';
import clsx from 'clsx';

interface ButtonProps {
    content: string | React.ReactNode;
    type?: "main" | "secondary";
    doOnClick?: () => void;
}


const Button = ({content, type = "main", doOnClick}: ButtonProps) => {

    return (
        <div>
            <button className={clsx("rounded-xl m-0 transition duration-200 ease-in-out antialiased cursor-pointer", {
                "px-3 py-2 bg-accent hover:bg-accentDark": type === "main",
                "px-3 py-2 hover:text-neutral-400": type === "secondary"
            })}
                    onClick={doOnClick}>
                {content}
            </button>
        </div>
    );
};

export default Button;