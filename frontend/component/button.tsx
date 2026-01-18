'use client';
import React from 'react';
import clsx from 'clsx';

interface ButtonProps {
    content: string | React.ReactNode;
    type?: "main" | "secondary";
    doOnClick?: () => void;
    customCSS?: string;
}


const Button = ({content, type = "main", doOnClick, customCSS}: ButtonProps) => {

    return (
        <div>
            <button className={clsx(`rounded-xl m-0 hover:transition hover:duration-200 hover:ease-in-out antialiased cursor-pointer ${customCSS}`, {
                "px-3 py-2 bg-primary hover:bg-primaryDark active:scale-105 active:duration-75": type === "main",
                "px-3 py-2 hover:text-neutral-400"  : type === "secondary"
            })}
                    onClick={doOnClick}>
                {content}
            </button>
        </div>
    );
};

export default Button;