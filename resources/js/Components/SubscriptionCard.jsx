import Button from "@/Components/Button";
export default function SubscriptionCard({
    id,
    name,
    price,
    durationInMonth,
    features,
    isPremium,
    onSelectSubscription,
}) {
    return (
        <>
            {/* <!-- Basic --> */}
            {!isPremium ? (
                <div className="flex flex-col gap-[30px] py-[30px] px-7 outline outline-1 outline-[#F1F1F1] rounded-[26px] text-black w-[300px] h-[max-content]">
                    {/* <!-- Top Content: Name-Price --> */}
                    <div>
                        <div className="text-sm mb-2">{name}</div>
                        <div className="text-[28px] font-bold">
                            IDR {price.toLocaleString()}
                        </div>
                        <p className="text-gray-1 text-xs font-light">
                            /{durationInMonth} months
                        </p>
                    </div>

                    {/* <!-- Mid Content: Benefits --> */}
                    <div className="flex flex-col gap-4">
                        {features.map((feature, index) => (
                            <div
                                className="flex items-center gap-2"
                                key={`${index}-${id}-${feature.name}`}
                            >
                                <img src="/icons/ic_tick.svg" alt="img" />
                                <span className="text-sm">{feature.name}</span>
                            </div>
                        ))}
                    </div>

                    {/* <!-- Bottom: CTA Button --> */}
                    <div onClick={onSelectSubscription}>
                        <Button type="button" variant="white-outline">
                            <span className="text-base">Start {name}</span>
                        </Button>
                    </div>
                </div>
            ) : (
                <div className="flex flex-col gap-[30px] py-[30px] px-7 outline outline-1 outline-[#F1F1F1] rounded-[26px] text-white w-[300px] bg-black">
                    {/* <!-- Ornament Icon --> */}
                    <div className="bg-alerange rounded-full p-[13px] max-w-max">
                        <img src="/icons/ic_star.svg" width="24" alt="img" />
                    </div>
                    {/* <!-- Top Content: Name-Price --> */}
                    <div>
                        <div className="text-sm mb-2">{name}</div>
                        <div className="text-[28px] font-bold">
                            IDR {price.toLocaleString()}
                        </div>
                        <p className="text-[#767676] text-xs font-light">
                            /{durationInMonth} months
                        </p>
                    </div>

                    {/* <!-- Mid Content: Benefits --> */}
                    <div className="flex flex-col gap-4">
                        {features.map((feature, index) => (
                            <div
                                className="flex items-center gap-2"
                                key={`${index}-${id}-${feature.name}`}
                            >
                                <img src="/icons/ic_tick.svg" alt="img" />
                                <span className="text-sm">{feature.name}</span>
                            </div>
                        ))}
                    </div>

                    {/* <!-- Bottom: CTA Button --> */}
                    <div onClick={onSelectSubscription}>
                        <Button type="button">
                            <span className="text-base font-semibold">
                                Subscribe Now
                            </span>
                        </Button>
                    </div>
                </div>
            )}
        </>
    );
}
