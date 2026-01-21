'use client';
import React, {ReactNode} from 'react';
import clsx from 'clsx';

interface ButtonProps {
    reactNode?: ReactNode;
    content?: string;
    style?: "main" | "secondary";
    buttonType?: "button" | "submit" | "reset" | undefined;
    onClick?: () => void;
    customCSS?: string;
}


const Button = ({content, style = "main", onClick, customCSS, reactNode, buttonType = "button"}: ButtonProps) => {
    
    //TODO resolver erro abaixo :(
    return (
        <div>
            <button
                className={clsx(`rounded-xl m-0 hover:transition hover:duration-200 hover:ease-in-out antialiased cursor-pointer ${customCSS}`, {
                    "px-3 py-2 bg-primary hover:bg-primaryDark active:scale-105 active:duration-75": style === "main",
                    "px-3 py-2 hover:text-neutral-400": style === "secondary"
                })}
                type={buttonType}
                onClick={onClick}>
                {reactNode}
                {content}
            </button>
        </div>
    );
};

export default Button;